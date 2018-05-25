<?php

namespace App\Http\Controllers\Backend\Personnel;

use App\Http\Controllers\Controller;
use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use App\Models\Goals;
use App\Models\Revenues;
use DateInterval;
use DatePeriod;
use DateTime;
use DB;
use App\Helpers\Backend\Utilities;
use Illuminate\Http\Request;
use App\Helpers\OfficeHelper;
use Validator, ArrayPaginator;

class BusinessController extends Controller
{

    public function getWorkingDaysCount($from, $to)
    {
        $workingDays = [1, 2, 3, 4, 5];         // Working days (week days)
        $holidayDays = [
            '*-09-02',
            '*-01-01',
            '*-04-30',
            '*-05-01',
            '*-05-01',
        ];  // Holidays array, add desired dates to this array

        $from = new DateTime($from);
        $to = new DateTime($to);
        $to->modify('+1 day');
        $interval = new DateInterval('P1D');
        $periods = new DatePeriod($from, $interval, $to);

        $days = 0;
        foreach ($periods as $period) {
            if (!in_array($period->format('N'), $workingDays)) continue;
            if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
            if (in_array($period->format('*-m-d'), $holidayDays)) continue;
            $days++;
        }
        return $days;
    }

    public function firstDayOf($period, DateTime $date = null)
    {
        $period = strtolower($period);
        $validPeriods = array('year', 'quarter', 'month', 'week');

        if (!in_array($period, $validPeriods))
            throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));

        $newDate = ($date === null) ? new DateTime() : clone $date;

        switch ($period) {
            case 'year':
                $newDate->modify('first day of january ' . $newDate->format('Y'));
                break;
            case 'quarter':
                $month = $newDate->format('n');

                if ($month < 4) {
                    $newDate->modify('first day of january ' . $newDate->format('Y'));
                } elseif ($month > 3 && $month < 7) {
                    $newDate->modify('first day of april ' . $newDate->format('Y'));
                } elseif ($month > 6 && $month < 10) {
                    $newDate->modify('first day of july ' . $newDate->format('Y'));
                } elseif ($month > 9) {
                    $newDate->modify('first day of october ' . $newDate->format('Y'));
                }
                break;
            case 'month':
                $newDate->modify('first day of this month');
                break;
            case 'week':
                $newDate->modify(($newDate->format('w') === '0') ? 'monday last week' : 'monday this week');
                break;
        }


        return $newDate;
    }

    public function array_multiSort_by_column($arr, $column, $false = false)
    {
        foreach ($arr as $key => $row) {
            $value[$key] = $row[$column];
        }

        if (!empty($value)) {
            if ($false) {
                array_multisort($value, SORT_ASC, $arr);
                return $arr;
            }

            array_multisort($value, SORT_DESC, $arr);
        }

        return $arr;
    }


    public function sortArrayDescByColumn($arr, $column)
    {
        usort($arr, function ($a, $b) use ($column) {
            $b[$column] - $a[$column];

        });

        return $arr;
    }

    public function sortArrayAscByColumn($arr, $column)
    {
        usort($arr, function ($a, $b) use ($column) {
            return $a[$column] - $b[$column];
        });

        return $arr;
    }

    public function searchOrderByValue($data, $field, $value)
    {
        $order = $this->searchKeyByValue($data, $field, $value);

        if ($order !== false) {
            $order++;
        }

        return $order;
    }

    public function searchKeyByValue($data, $field, $value)
    {

        foreach ($data as $key => $datum) {
            if ($datum[$field] === $value) {
                return $key;
            }

        }
        return null;
    }

    public function filterKeyArray($array1, $arraySearch)
    {
        $data = array_filter($array1, function ($key) use ($arraySearch) {
            return in_array($key, $arraySearch);
        }, ARRAY_FILTER_USE_KEY);
        return $data;
    }

    public function getAllMonthlyInYear()
    {
        $list_monthly = [];

        for ($m = 1; $m <= 12; $m++) {
            array_push($list_monthly, strtolower(strftime("%B", mktime(0, 0, 0, $m, 12))));
        }

        return $list_monthly;
    }


    public function getPlanBusiness()
    {

        // get all month this year

        $list_monthly = $this->getAllMonthlyInYear();

        // get from first month to last month this year

        $users = User::where('goal', '>', 0)->where('status', 1)->where('id', '<>', 1)->get();

        if (empty($users)) {
            abort(404);
        }

        $array_user = [];

        $uids = [];

        foreach ($users as $user) {

            $goal = round($user->goal / 12, 2);

            $bolean = false;

            foreach ($list_monthly as $key => $item) {
                $revenue = Revenues::select('uid', DB::raw('SUM(revenue) as revenues'))->whereBetween('datetime', [date('Y-m-d', strtotime('first day of ' . $item . ' this year')), date('Y-m-d', strtotime('last day of ' . $item . ' this year'))])->groupBy('uid')->get();

                // đầu tiên gán giá trị tất cả bằng rỗng

                $array_user[$user->id][$key + 1]['id'] = $user->id;
                $array_user[$user->id][$key + 1]['username'] = $user->first_name . " " . $user->last_name;
                $array_user[$user->id][$key + 1]['revenue'] = 0;
                ($bolean) ? $bolean = false : $array_user[$user->id][$key + 1]['goal'] = $goal;


                $array_user[$user->id][$key + 1]['revenue_goal'] = 0;

                // sau đó add lại giá trị

                foreach ($revenue as $key2 => $item2) {
                    if ($user->id == $item2->uid) {
                        if (!in_array($user->id, $uids)) {
                            array_push($uids, $user->id);
                        }

                        $revenue_goal = $goal - $item2->revenues;

                        $array_user[$user->id][$key + 1]['revenue_goal'] = $revenue_goal;

                        $array_user[$user->id][$key + 1]['revenue'] = $item2->revenues;

                        if ((int)$revenue_goal > 0) {
                            if ($key + 2 <= sizeof($list_monthly)) {
                                $array_user[$user->id][$key + 2]['goal'] = $goal + $revenue_goal;
                                $bolean = true;
                            }
                        }
                    }
                }
            }

        }

        $users = $this->filterKeyArray($array_user, $uids);

        if (access()->user()->hasRoles(['Kỹ thuật', 'Giám đốc', 'Trưởng phòng'])) {

        } elseif (access()->user()->hasRole('Nhân viên')) {

            // lọc mảng to, trả về mảng mới chỉ có mỗi nhân viên đang đăng nhập
            $users = $this->filterKeyArray($users, [access()->id()]);

            if (empty($users)) {
                $users = [];
            }
        }

        return view('backend.personnel.plan_business', ['users' => $users, 'list_monthly' => $list_monthly]);
    }

    public function searchPlanBusiness(Request $request)
    {

        $id_and_name = ltrim($request->multi_column, "0");

        if (empty($id_and_name)) {
            return redirect()->route('admin.personnel.business.plan.business')->withFlashWarning('không có dữ liệu như bạn tìm kiếm . Hãy thử lại');
        }

        // get all month this year

        $list_monthly = $this->getAllMonthlyInYear();

        // get from first month to last month this year

        $users = User::where(function ($query) use ($id_and_name) {
            $query->where('id', $id_and_name)->where('last_name', $id_and_name)->orWhere('id', 'like', '%' . $id_and_name . '%')->orWhere('last_name', 'like', '%' . $id_and_name . '%');
        })->where('goal', '>', 0)->where('status', 1)->where('id', '<>', 1)->orderBy('goal', 'desc')->get();

        $array_user = [];

        $uids = [];

        foreach ($users as $user) {

            $goal = round($user->goal / 12, 2);

            $bolean = false;

            foreach ($list_monthly as $key => $item) {
                $revenue = Revenues::select('uid', DB::raw('SUM(revenue) as revenues'))->whereBetween('datetime', [date('Y-m-d', strtotime('first day of ' . $item . ' this year')), date('Y-m-d', strtotime('last day of ' . $item . ' this year'))])->groupBy('uid')->get();

                // đầu tiên gán giá trị tất cả bằng rỗng

                $array_user[$user->id][$key + 1]['id'] = $user->id;
                $array_user[$user->id][$key + 1]['username'] = $user->first_name . " " . $user->last_name;
                $array_user[$user->id][$key + 1]['revenue'] = 0;
                ($bolean) ? $bolean = false : $array_user[$user->id][$key + 1]['goal'] = $goal;


                $array_user[$user->id][$key + 1]['revenue_goal'] = 0;

                // sau đó add lại giá trị

                foreach ($revenue as $key2 => $item2) {
                    if ($user->id == $item2->uid) {
                        if (!in_array($user->id, $uids)) {
                            array_push($uids, $user->id);
                        }

                        $revenue_goal = $goal - $item2->revenues;

                        $array_user[$user->id][$key + 1]['revenue_goal'] = $revenue_goal;

                        $array_user[$user->id][$key + 1]['revenue'] = $item2->revenues;

                        if ((int)$revenue_goal > 0) {
                            if ($key + 2 <= sizeof($list_monthly)) {
                                $array_user[$user->id][$key + 2]['goal'] = $goal + $revenue_goal;
                                $bolean = true;
                            }
                        }
                    }
                }
            }

        }

        $users = $this->filterKeyArray($array_user, $uids);

        return view('backend.personnel.plan_business', ['users' => $users, 'list_monthly' => $list_monthly]);
    }


    public function getIndex($page = 1)
    {

        $today = new DateTime(date('Y-m-d H:i:s'));
        $first_day_quarter = $this->firstDayOf('quarter', $today);

        $daily_users_revenues = Revenues::select('uid', DB::raw('SUM(revenue) as revenues'))
            ->whereDate('datetime', date('Y-m-d'))
            ->groupBy('uid')
            ->get();

        //lũy kế tháng, tính từ đầu tháng đến hôm nay
        $monthly_revenues_accumulated = Revenues::select('uid', DB::raw('SUM(revenue) as revenues'), DB::raw('SUM(profit) as profits'), DB::raw('COUNT(DISTINCT company_id) as count_company'))
            ->whereBetween('datetime', [date('Y-m-01 00:00:00'), date('Y-m-d 23:59:59')])
            ->groupBy('uid')
            ->get();

        //lũy kế quý, tính từ đầu qúy đến hôm nay
        $quarter_revenues_accumulated = Revenues::select('uid', DB::raw('SUM(revenue) as revenues'))
            ->whereBetween('datetime', [$first_day_quarter->format('Y-m-01 00:00:00'), date('Y-m-d 23:59:59')])
            ->groupBy('uid')
            ->get();

        //lũy kế năm, tính từ đầu năm đến hôm nay
        $yearly_revenues_accumulated = Revenues::select('uid', DB::raw('SUM(revenue) as revenues'))
            ->whereBetween('datetime', [date('Y-01-01 00:00:00'), date('Y-m-d 23:59:59')])
            ->groupBy('uid')
            ->get();
        $users = [];

        $uids = [];

        foreach ($yearly_revenues_accumulated as $datum) {
            $uids[] = $datum->uid;

            $users[$datum->uid]['daily_revenues'] = 0;
            $users[$datum->uid]['monthly_revenues_accumulated'] = 0;
            $users[$datum->uid]['monthly_profit_accumulated'] = 0;
            $users[$datum->uid]['quarter_revenues_accumulated'] = 0;
            $users[$datum->uid]['count_company'] = 0;
            $users[$datum->uid]['yearly_revenues_accumulated'] = $datum->revenues;
        }

        foreach ($quarter_revenues_accumulated as $datum) {
            $users[$datum->uid]['quarter_revenues_accumulated'] = $datum->revenues;
        }

        foreach ($monthly_revenues_accumulated as $datum) {
            $users[$datum->uid]['monthly_revenues_accumulated'] = $datum->revenues;
            $users[$datum->uid]['monthly_profit_accumulated'] = $datum->profits;
            $users[$datum->uid]['count_company'] = $datum->count_company;
        }

        foreach ($daily_users_revenues as $datum) {
            $users[$datum->uid]['daily_revenues'] = $datum->revenues;
        }

        $_users = User::whereIn('id', $uids)->where('goal', '>', 0)->get(['id', 'avatar', 'first_name', 'last_name', 'pid', 'goal']);
        $working_days = $this->getWorkingDaysCount(date('Y-m-01'), date('Y-m-t')); // số ngày làm việc trong tháng
        $working_days_passed = $this->getWorkingDaysCount(date('Y-m-01'), date('Y-m-d', time() + 86400)); // số ngày làm việc tính tới ngày hôm qua


        foreach ($_users as $_user) {
            $goal = round($_user->goal / 12, 2);

            //lấy thông tin cơ bản vào mảng chính
            $users[$_user->id]['id'] = $_user->id;
            $users[$_user->id]['avatar'] = $_user->avatar;
            $users[$_user->id]['name'] = $_user->first_name . ' ' . $_user->last_name;
            $users[$_user->id]['pid'] = $_user->pid;
            $users[$_user->id]['goal'] = $goal;
            $users[$_user->id]['revenue_by_goal'] = 'N/A';

            //tính Doanh thu/khách hàng theo chỉ tiêu KH tháng
            //Chẳng hạn chỉ tiêu tháng 50 tr, tháng này có 20 ngày công ( trừ t7 cn), thì chỉ tiêu 1 ngày là 2tr5, hôm xem phần mềm là giữa tháng, đã qua 10 ngày công thì chỗ này hiển thị 25tr

            $goal_per_day = round($goal / $working_days, 2);
            $revenue_by_goal = round($goal_per_day * $working_days_passed, 2);


            $users[$_user->id]['revenue_by_goal'] = $revenue_by_goal;

            //END tính Doanh thu/khách hàng theo chỉ tiêu KH tháng

            //tính % Doanh thu/khách hàng theo KH tháng, quý, năm

            $users[$_user->id]['monthly_revenues_ratio'] = round(($users[$_user->id]['monthly_revenues_accumulated'] / $goal) * 100, 2);
            $users[$_user->id]['quarter_revenues_ratio'] = round(($users[$_user->id]['quarter_revenues_accumulated'] / ($goal * 3)) * 100, 2);
            $users[$_user->id]['yearly_revenues_ratio'] = round(($users[$_user->id]['yearly_revenues_accumulated'] / ($goal * 12)) * 100, 2);
            //END tính % Doanh thu/khách hàng theo KH tháng, quý, năm

            //Doanh thu/khách hàng còn thiếu theo KH tháng, quý, năm
            $monthly_revenues_lack = $goal - $users[$_user->id]['monthly_revenues_accumulated'];
            $quarter_revenues_lack = ($goal * 3) - $users[$_user->id]['quarter_revenues_accumulated'];
            $yearly_revenues_lack = ($goal * 12) - $users[$_user->id]['yearly_revenues_accumulated'];

            $users[$_user->id]['monthly_revenues_lack'] = $monthly_revenues_lack > 0 ? $monthly_revenues_lack : 0;
            $users[$_user->id]['quarter_revenues_lack'] = $quarter_revenues_lack > 0 ? $quarter_revenues_lack : 0;
            $users[$_user->id]['yearly_revenues_lack'] = $yearly_revenues_lack > 0 ? $yearly_revenues_lack : 0;
            //END Doanh thu/khách hàng còn thiếu theo KH tháng, quý, năm
        }

        //xếp lại mảng theo từng tiêu chí

        $users_by_count_company = $this->array_multiSort_by_column($users, 'count_company', true);
        $users_by_monthly_revenues_accumulated = $this->array_multiSort_by_column($users, 'monthly_revenues_accumulated', true);
        $users_by_monthly_profit_accumulated = $this->array_multiSort_by_column($users, 'monthly_profit_accumulated', true);
        $users_by_quarter_revenues_accumulated = $this->array_multiSort_by_column($users, 'quarter_revenues_accumulated', true);
        $users_by_yearly_revenues_accumulated = $this->array_multiSort_by_column($users, 'yearly_revenues_accumulated', true);

        $total_sales = count($users);
        foreach ($_users as $_user) {//lặp lại mảng người dùng để thêm dữ liệu sau khi đã xếp mảng theo tiêu chí

            //vị trí xếp hạng người dùng theo các tiêu chí (tìm khóa của mảng (trong mảng to) theo cột id của mảng nhỏ)
            $users[$_user->id]['ranking_by_count_company'] = $this->searchOrderByValue($users_by_count_company, 'id', $_user->id);
            $users[$_user->id]['ranking_by_monthly_revenues_accumulated'] = $this->searchOrderByValue($users_by_monthly_revenues_accumulated, 'id', $_user->id);
            $users[$_user->id]['ranking_by_monthly_profit_accumulated'] = $this->searchOrderByValue($users_by_monthly_profit_accumulated, 'id', $_user->id);

            //tính số chênh doanh thu với người đứng đầu
            $monthly_revenues_vs_1st = $users_by_monthly_revenues_accumulated[0]['monthly_revenues_accumulated'] - $users[$_user->id]['monthly_revenues_accumulated'];
            $quarter_revenues_vs_1st = $users_by_quarter_revenues_accumulated[0]['quarter_revenues_accumulated'] - $users[$_user->id]['quarter_revenues_accumulated'];
            $yearly_revenues_vs_1st = $users_by_yearly_revenues_accumulated[0]['yearly_revenues_accumulated'] - $users[$_user->id]['yearly_revenues_accumulated'];

            $users[$_user->id]['monthly_revenues_vs_1st'] = $monthly_revenues_vs_1st > 0 ? $monthly_revenues_vs_1st : 0;
            $users[$_user->id]['quarter_revenues_vs_1st'] = $quarter_revenues_vs_1st > 0 ? $quarter_revenues_vs_1st : 0;
            $users[$_user->id]['yearly_revenues_vs_1st'] = $yearly_revenues_vs_1st > 0 ? $yearly_revenues_vs_1st : 0;
        }

        //tạm thời xếp mảng theo doanh thu tháng lũy kế
        //todo: làm rõ các tiêu chí cần xếp hạng

//        $users = $this->sortArrayDescByColumn($users, 'monthly_revenues_accumulated');
        $users = $this->array_multiSort_by_column($users, 'monthly_revenues_accumulated');

        $users[0]['orderBy_monthly_revenues_accumulated'] = 'asc';

        if (access()->user()->hasRoles(['Kỹ thuật', 'Giám đốc', 'Trưởng phòng'])) {

        } elseif (access()->user()->hasRole('Nhân viên')) {

            //Nhân viên thì chỉ xem được chính họ

            $user_id_key = $this->searchKeyByValue($users, 'id', access()->id());

            if ($user_id_key !== null) {
                // lọc mảng to, trả về mảng mới chỉ có mỗi nhân viên đang đăng nhập
                $users = [$users[$user_id_key]];
            } else {
                $users = [];
            }

        } else {
            abort(404);
        }

        $url_pattern = route('admin.personnel.business.index') . '/(:num)';

        $paginator = new ArrayPaginator($users, $page, $url_pattern);

        $users = $paginator->getResult();

        $paginator_html = $paginator->render();

        return view('backend.personnel.business', compact('users', 'total_sales', 'paginator_html'));
    }

    public function getAddGoals(Request $request)
    {
        $goals = Goals::find(1);

        return view('backend.personnel.add_goals', compact('goals'));
    }

    public function postAddGoals(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'goals' => 'required|integer',
        ]);

        $validator->setAttributeNames([
            'goals' => 'Chỉ tiêu',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $goals = Goals::firstOrCreate(['id' => 1]);

        $goals->goals = $request->input('goals');

        $goals->save();

        $sales = Role::find(3)->users;

        $goal = round(($goals->goals / 12) / $sales->count(), 2);

        foreach ($sales as $sale) {
            $sale->goal = $goal;
            $sale->save();
        }

        return view('backend.personnel.add_goals', compact('goals'))->withFlashSuccess('Thêm chỉ tiêu thành công.');
    }

    public function ajaxBusinessChangeField(Request $request, $page = 1)
    {

        $today = new DateTime(date('Y-m-d H:i:s'));
        $first_day_quarter = $this->firstDayOf('quarter', $today);

        $daily_users_revenues = Revenues::select('uid', DB::raw('SUM(revenue) as revenues'))
            ->whereDate('datetime', date('Y-m-d'))
            ->groupBy('uid')
            ->get();

        //lũy kế tháng, tính từ đầu tháng đến hôm nay
        $monthly_revenues_accumulated = Revenues::select('uid', DB::raw('SUM(revenue) as revenues'), DB::raw('SUM(profit) as profits'), DB::raw('COUNT(DISTINCT company_id) as count_company'))
            ->whereBetween('datetime', [date('Y-m-01 00:00:00'), date('Y-m-d 23:59:59')])
            ->groupBy('uid')
            ->get();

        //lũy kế quý, tính từ đầu qúy đến hôm nay
        $quarter_revenues_accumulated = Revenues::select('uid', DB::raw('SUM(revenue) as revenues'))
            ->whereBetween('datetime', [$first_day_quarter->format('Y-m-01 00:00:00'), date('Y-m-d 23:59:59')])
            ->groupBy('uid')
            ->get();

        //lũy kế năm, tính từ đầu năm đến hôm nay
        $yearly_revenues_accumulated = Revenues::select('uid', DB::raw('SUM(revenue) as revenues'))
            ->whereBetween('datetime', [date('Y-01-01 00:00:00'), date('Y-m-d 23:59:59')])
            ->groupBy('uid')
            ->get();

        $users = [];

        $uids = [];

        foreach ($yearly_revenues_accumulated as $datum) {

            array_push($uids, $datum->uid);
            $users[$datum->uid]['daily_revenues'] = 0;
            $users[$datum->uid]['monthly_revenues_accumulated'] = 0;
            $users[$datum->uid]['monthly_profit_accumulated'] = 0;
            $users[$datum->uid]['quarter_revenues_accumulated'] = 0;
            $users[$datum->uid]['count_company'] = 0;
            $users[$datum->uid]['yearly_revenues_accumulated'] = $datum->revenues;
        }

        foreach ($monthly_revenues_accumulated as $datum) {
            $users[$datum->uid]['monthly_revenues_accumulated'] = $datum->revenues;
            $users[$datum->uid]['monthly_profit_accumulated'] = $datum->profits;
            $users[$datum->uid]['count_company'] = $datum->count_company;
        }

        foreach ($quarter_revenues_accumulated as $datum) {
            $users[$datum->uid]['quarter_revenues_accumulated'] = $datum->revenues;
        }


        foreach ($daily_users_revenues as $datum) {
            $users[$datum->uid]['daily_revenues'] = $datum->revenues;
        }

        $working_days = $this->getWorkingDaysCount(date('Y-m-01'), date('Y-m-t')); // số ngày làm việc trong tháng

        $working_days_passed = $this->getWorkingDaysCount(date('Y-m-01'), date('Y-m-d', time() + 86400)); // số ngày làm việc tính tới ngày hôm qua

        $_users = User::whereIn('id', $uids)->where('goal', '>', 0)->get(['id', 'avatar', 'first_name', 'last_name', 'pid', 'goal']);

        $uids = [];

        foreach ($_users as $item) {
            array_push($uids, $item->id);
        }

        // filter loại bỏ những phần tử không có trong mảng $_users
        $users = $this->filterKeyArray($users, $uids);

        foreach ($_users as $_user) {

            $goal = round($_user->goal / 12, 2);

            //lấy thông tin cơ bản vào mảng chính
            $users[$_user->id]['id'] = $_user->id;
            $users[$_user->id]['avatar'] = $_user->avatar;
            $users[$_user->id]['name'] = $_user->first_name . ' ' . $_user->last_name;
            $users[$_user->id]['pid'] = $_user->pid;
            $users[$_user->id]['goal'] = $goal;
            $users[$_user->id]['revenue_by_goal'] = 'N/A';

            //tính Doanh thu/khách hàng theo chỉ tiêu KH tháng
            //Chẳng hạn chỉ tiêu tháng 50 tr, tháng này có 20 ngày công ( trừ t7 cn), thì chỉ tiêu 1 ngày là 2tr5, hôm xem phần mềm là giữa tháng, đã qua 10 ngày công thì chỗ này hiển thị 25tr

            $goal_per_day = round($goal / $working_days, 2);
            $revenue_by_goal = round($goal_per_day * $working_days_passed, 2);

            $users[$_user->id]['revenue_by_goal'] = $revenue_by_goal;

            //END tính Doanh thu/khách hàng theo chỉ tiêu KH tháng

            //tính % Doanh thu/khách hàng theo KH tháng, quý, năm

            $users[$_user->id]['monthly_revenues_ratio'] = round(($users[$_user->id]['monthly_revenues_accumulated'] / $goal) * 100, 2);
            $users[$_user->id]['quarter_revenues_ratio'] = round(($users[$_user->id]['quarter_revenues_accumulated'] / ($goal * 3)) * 100, 2);
            $users[$_user->id]['yearly_revenues_ratio'] = round(($users[$_user->id]['yearly_revenues_accumulated'] / ($goal * 12)) * 100, 2);
            //END tính % Doanh thu/khách hàng theo KH tháng, quý, năm

            //Doanh thu/khách hàng còn thiếu theo KH tháng, quý, năm
            $monthly_revenues_lack = $goal - $users[$_user->id]['monthly_revenues_accumulated'];
            $quarter_revenues_lack = ($goal * 3) - $users[$_user->id]['quarter_revenues_accumulated'];
            $yearly_revenues_lack = ($goal * 12) - $users[$_user->id]['yearly_revenues_accumulated'];

            $users[$_user->id]['monthly_revenues_lack'] = $monthly_revenues_lack > 0 ? $monthly_revenues_lack : 0;
            $users[$_user->id]['quarter_revenues_lack'] = $quarter_revenues_lack > 0 ? $quarter_revenues_lack : 0;
            $users[$_user->id]['yearly_revenues_lack'] = $yearly_revenues_lack > 0 ? $yearly_revenues_lack : 0;
            //END Doanh thu/khách hàng còn thiếu theo KH tháng, quý, năm
        }


        //xếp lại mảng theo từng tiêu chí

        $users_by_count_company = $this->array_multiSort_by_column($users, 'count_company', true);
        $users_by_monthly_revenues_accumulated = $this->array_multiSort_by_column($users, 'monthly_revenues_accumulated', true);
        $users_by_monthly_profit_accumulated = $this->array_multiSort_by_column($users, 'monthly_profit_accumulated', true);
        $users_by_quarter_revenues_accumulated = $this->array_multiSort_by_column($users, 'quarter_revenues_accumulated', true);
        $users_by_yearly_revenues_accumulated = $this->array_multiSort_by_column($users, 'yearly_revenues_accumulated', true);


        $total_sales = count($users);

        foreach ($_users as $_user) {//lặp lại mảng người dùng để thêm dữ liệu sau khi đã xếp mảng theo tiêu chí

            //vị trí xếp hạng người dùng theo các tiêu chí (tìm khóa của mảng (trong mảng to) theo cột id của mảng nhỏ)
            $users[$_user->id]['ranking_by_count_company'] = $this->searchOrderByValue($users_by_count_company, 'id', $_user->id);
            $users[$_user->id]['ranking_by_monthly_revenues_accumulated'] = $this->searchOrderByValue($users_by_monthly_revenues_accumulated, 'id', $_user->id);
            $users[$_user->id]['ranking_by_monthly_profit_accumulated'] = $this->searchOrderByValue($users_by_monthly_profit_accumulated, 'id', $_user->id);

            //tính số chênh doanh thu với người đứng đầu
            $monthly_revenues_vs_1st = $users_by_monthly_revenues_accumulated[0]['monthly_revenues_accumulated'] - $users[$_user->id]['monthly_revenues_accumulated'];
            $quarter_revenues_vs_1st = $users_by_quarter_revenues_accumulated[0]['quarter_revenues_accumulated'] - $users[$_user->id]['quarter_revenues_accumulated'];
            $yearly_revenues_vs_1st = $users_by_yearly_revenues_accumulated[0]['yearly_revenues_accumulated'] - $users[$_user->id]['yearly_revenues_accumulated'];

            $users[$_user->id]['monthly_revenues_vs_1st'] = $monthly_revenues_vs_1st > 0 ? $monthly_revenues_vs_1st : 0;
            $users[$_user->id]['quarter_revenues_vs_1st'] = $quarter_revenues_vs_1st > 0 ? $quarter_revenues_vs_1st : 0;
            $users[$_user->id]['yearly_revenues_vs_1st'] = $yearly_revenues_vs_1st > 0 ? $yearly_revenues_vs_1st : 0;
        }


        //todo: làm rõ các tiêu chí cần xếp hạng
        if ($request->orderBy == 'asc') {
            $users = $this->array_multiSort_by_column($users, $request->value, true);
        } else {
            $users = $this->array_multiSort_by_column($users, $request->value);
        }

        if (access()->user()->hasRoles(['Kỹ thuật', 'Giám đốc', 'Trưởng phòng'])) {

        } elseif (access()->user()->hasRole('Nhân viên')) {
            //Nhân viên thì chỉ xem được chính họ

            $user_id_key = $this->searchKeyByValue($users, 'id', access()->id());
            // lọc mảng to, trả về mảng mới chỉ có mỗi nhân viên đang đăng nhập
            if ($user_id_key !== null) {
                // lọc mảng to, trả về mảng mới chỉ có mỗi nhân viên đang đăng nhập
                $users = [$users[$user_id_key]];
            } else {
                $users = [];
            }
        } else {
            abort(404);
        }

        if (!$request->report) {

            $url = '?value=' . $request->value . '&orderBy=' . $request->orderBy;

            $url_pattern = route('admin.personnel.business.ajax.business.change.field') . '/(:num)' . $url . '';

            $paginator = new ArrayPaginator($users, $page, $url_pattern);


            $result = $paginator->getResult();

            $paginator_html = $paginator->render();

            $view = view('backend.personnel.ajax_business_change_field', ['users' => $result, 'total_sales' => $total_sales, 'paginator_html' => $paginator_html, 'value' => $request->value, 'order' => $request->orderBy]);

            $result = [
                'status' => true,
                'data' => $view . "",
            ];

            return json_encode($result);
        } else {
            $id = explode(',', $request->report);
            foreach ($users as $list) {
                foreach ($id as $value) {
                    if ($list['id'] == $value) {
                        $exportxls['Tên'][] = $list['name'];
                        $exportxls['Mã NV'][] = Utilities::getPID($list['id']);
                        $exportxls['Kế hoạch chỉ tiêu tháng'][] = number_format($list['goal'], 2, ',', ' ');
                        $exportxls['Doanh thu trong ngày'][] = number_format($list['daily_revenues'], 0, '', '.');
                        $exportxls['Doanh thu theo chỉ tiêu tháng'][] = number_format($list['revenue_by_goal'], 2, ',', '.');
                        $exportxls['Doanh thu lũy kế tháng'][] = number_format($list['monthly_revenues_accumulated'], 2, ',', '.');
                        $exportxls['Doanh thu lũy kế quý'][] = number_format($list['quarter_revenues_accumulated'], 2, ',', '.');
                        $exportxls['Doanh thu lũy kế năm'][] = number_format($list['yearly_revenues_accumulated'], 2, ',', '.');
                        $exportxls['Doanh thu tháng'][] = number_format($list['monthly_revenues_ratio'], 2, ',', '.');
                        $exportxls['Doanh thu quý'][] = number_format($list['quarter_revenues_ratio'], 2, ',', '.');
                        $exportxls['Doanh thu năm'][] = number_format($list['yearly_revenues_ratio'], 2, ',', '.');
                        $exportxls['Doanh thu còn thiếu so với kế hoạch tháng'][] = number_format($list['monthly_revenues_lack'], 0, '', '.');
                        $exportxls['Doanh thu còn thiếu so với kế hoạch quý'][] = number_format($list['quarter_revenues_lack'], 0, '', '.');
                        $exportxls['Doanh thu còn thiếu so với kế hoạch năm'][] = number_format($list['yearly_revenues_lack'], 0, '', '.');
                        $exportxls['Doanh thu so với người thứ nhất tháng'][] = number_format($list['monthly_revenues_vs_1st'], 0, '', '.');
                        $exportxls['Doanh thu so với người thứ nhất quý'][] = number_format($list['quarter_revenues_vs_1st'], 0, '', '.');
                        $exportxls['Doanh thu so với người thứ nhất năm'][] = number_format($list['yearly_revenues_vs_1st'], 0, '', '.');
                        $exportxls['Xếp hạng theo doanh thu'][] = $list['ranking_by_count_company'] / $total_sales;
                        $exportxls['Xếp hạng theo số khách hàng'][] = $list['ranking_by_monthly_revenues_accumulated'] / $total_sales;
                        $exportxls['Xếp hạng theo lợi nhuận'][] = $list['ranking_by_monthly_profit_accumulated'] / $total_sales;
                    }
                }
            }
            return OfficeHelper::exportExcel($exportxls, 'DSNV.xls');

        }
    }

}