<?php

class Calendar
{
    /*
        
    */
    var $startDay = 1;

    /*
        
    */
    var $startMonth = 1;

    /*
        
    */
    var $dayNames = array("D", "L", "M", "M", "J", "V", "S");

    /*
        
    */
    var $monthNames = array("Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie",
        "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie");

    /*
        
    */
    var $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    /*
        
    */
    var $dateLink = "";

    /*
        
    */
    var $calendarLink = "";

    /*
        
    */
    var $selectedDay = 0;


    /*
        Get the array of strings used to label the days of the week. This array contains seven
        elements, one for each day of the week. The first entry in this array represents Sunday.
    */
    var $selectedDaysNo = 0;

    /*
        Set the array of strings used to label the days of the week. This array must contain seven
        elements, one for each day of the week. The first entry in this array represents Sunday.
    */
    var $selectedDaysArr = array();

    /*
	Set selected day
    */
    var $formDetails = array();

    /*
	Get the day that was selected in the month
    */
var $tdheadbgcolor = '#cccccc';

    /*
	Get selected days number
    */
var $tdbgcolor = '#eeeeee';

    /*
	Set selected days number
    */
var $selected_tdbgcolor = '#eeeeee';

    /*
	Fixme:
    */
var $anothermonthcolor = '#000000';

    /*
	Fixme:
    
     function setSelectedDaysArr($a)
    {
	$this->selectedDaysArr=$a;
    }
    */

    /*
        Get the array of strings used to label the months of the year. This array contains twelve
        elements, one for each month of the year. The first entry in this array represents January.
    */

    function getTdeadbgcolor()
    {
        return $this->tdheadbgcolor;
    }

    /*
        Set the array of strings used to label the months of the year. This array must contain twelve
        elements, one for each month of the year. The first entry in this array represents January.
    */

    function setTdheadbgcolor($color)
    {
        $this->tdheadbgcolor = $color;
    }

    /*
        Gets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */

    function getTdbgcolor()
    {
        return $this->tdbgcolor;
    }

    /* 
        Sets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */

    function setTdbgcolor($color)
    {
        $this->tdbgcolor = $color;
    }

    /* 
        Gets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */

    function getSelectedTdbgcolor()
    {
        return $this->selected_tdbgcolor;
    }

    /* 
        Sets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */

    function setSelectedTdbgcolor($color)
    {
        $this->selected_tdbgcolor = $color;
    }

    /*
        Sets the URL to link to in order to display a calendar for a given month/year.
    */

    function getAnothermonthcolor()
    {
        return $this->anothermonethcolor;
    }

    /*
        Sets the URL to link to  for a given date.
    */

    function setAnothermonthcolor($color)
    {
        $this->anothermonthcolor = $color;
    }

    /*
        Return the URL to link to in order to display a calendar for a given month/year.
        You must override this method if you want to activate the "forward" and "back" 
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
        
        If the calendar is being displayed in "year" view, $month will be set to zero.
    */

    function getDayNames()
    {
        return $this->dayNames;
    }

    /*
        Return the URL to link to  for a given date.
        You must override this method if you want to activate the date linking
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
    */

    function setDayNames($names)
    {
        $this->dayNames = $names;
    }

    /*
	Get the mouse event action
    */

    function getSelectedDay()
    {
        return $this->selectedDay;
    }

    /*
	Set the mouse event action
    */

    function setSelectedDay($sd)
    {
        $this->selectedDay = $sd;
    }

    /*
        Return the HTML for the current month
	Event is an associative array. The indexes of the array are numbers between 1 and 
	the number of days in the month. The elements of the array will be written in the 
	proper cells.
	
    */

    function getSelectedDaysNo()
    {
        return $this->selectedDaysNo;
    }

    /*
        Return the HTML for the current year
    */

    function setSelectedDaysNo($no)
    {
        $this->selectedDaysNo = $no;
    }

    /*
        Return the HTML for a specified month
	Event is an associative array. The indexes of the array are numbers between 1 and
	the number of days in the specified month. The elements of the array will be written in the
	proper cells.
    */

    function getSelectedDaysArr()
    {
        return $this->selectedDaysArr;
    }

    /*
        Return the HTML for a specified year
    */

    function getMonthNames()
    {
        return $this->monthNames;
    }



    /********************************************************************************
     *
     * The rest are private methods. No user-servicable parts inside.
     *
     * You shouldn't need to call any of these functions directly.
     *********************************************************************************/


    /*
        Calculate the number of days in a month, taking into account leap years.
    */
    function setMonthNames($names)
    {
        $this->monthNames = $names;
    }


    /*
        Generate the HTML for a given month
    */

    function getStartDay()
    {
        return $this->startDay;
    }


    /*
        Generate the HTML for a given year
    */

    function setStartDay($day)
    {
        $this->startDay = $day;
    }

    /*
        Adjust dates to allow months > 12 and < 0. Just adjust the years appropriately.
        e.g. Month 14 of the year 2001 is actually month 2 of year 2002.
    */

    function getStartMonth()
    {
        return $this->startMonth;
    }

    /* 
        The start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */

    function setStartMonth($month)
    {
        $this->startMonth = $month;
    }

    /* 
        The start month of the year. This is the month that appears in the first slot
        of the calendar in the year view. January = 1.
    */

    function getFormDetails()
    {
        return $this->formDetails;
    }

    /*
        The labels to display for the days of the week. The first entry in this array
        represents Sunday.
    */

    function setFormDetails($f)
    {
        $this->formDetails = $f;
    }

    /*
        The labels to display for the months of the year. The first entry in this array
        represents January.
    */

    function getCurrentMonthView($event = array())
    {
        $d = getdate(time());
        return $this->getMonthView($d["mon"], $d["year"], $event);
    }

    /*
        The number of days in each month. You're unlikely to want to change this...
        The first entry in this array represents January.
    */

    function getMonthView($month, $year, $event = array(), $mylink = '')
    {
        return $this->getMonthHTML($month, $year, $event, 0, $mylink);
    }

    /*
	The URL to link to for a given date.
    */

    function getMonthHTML($m, $y, $events, $showYear = 0, $mylink = '')
    {
        $curr_date = date('Y') . date('m') . date('d');

        $this->selectedDaysArr = array();

        $s = "";

        $a = $this->adjustDate($m, $y);
        $month = $a[0];
        $year = $a[1];

        $daysInMonth = $this->getDaysInMonth($month, $year);
        $date = getdate(mktime(12, 0, 0, $month, 1, $year));

        $first = $date["wday"];
        $monthName = $this->monthNames[$month - 1];

        $prev = $this->adjustDate($month - 1, $year);
        $next = $this->adjustDate($month + 1, $year);

        $daysInPrevMonth = $this->getDaysInMonth($prev[0], $prev[1]);

        if ($showYear == 1) {
            $prevMonth = $this->getCalendarLink($prev[0], $prev[1], $this->selectedDay);
            $nextMonth = $this->getCalendarLink($next[0], $next[1], $this->selectedDay);

            $prevYear = $this->getCalendarLink($month, $year - 1, $this->selectedDay);
            $nextYear = $this->getCalendarLink($month, $year + 1, $this->selectedDay);
        } else {
            $prevMonth = "";
            $nextMonth = "";

            $prevYear = "";
            $nextYear = "";
        }

        $header = $monthName . (($showYear > 0) ? " " . $year : "");

        $tdheadbgcolor = $this->tdheadbgcolor;

        $s .= "<table class=\"calendar\" width=\"90%\" align=\"center\" cellpadding=\"0\" cellspacing=\"3\" border=\"0\">\n";

        $s .= "<tr>\n";
        for ($i = 0; $i < 7; $i++) {
            $class = (($this->startDay + $i) % 7 == 0 || ($this->startDay + $i) % 7 == 6) ? "calendar_zi_sapt" : "calendar_zi_sapt";
            $s .= "<td align=\"center\"valign=\"top\" class=\"$class\" bgcolor=\"$tdheadbgcolor\" width=\"28\" height=\"20\">" . $this->dayNames[($this->startDay + $i) % 7] . "</td>\n";
        }
        $s .= "</tr>\n";

        $s .= "<tr>\n";
        $s .= "<td valign=\"middle\" class=\"calendar_data_inactiva_fara_link\" style=\"text-align: left;\" colspan=\"7\" height=\"20\">";
        $s .= "&nbsp;" . $header . "&nbsp;";
        $s .= "</td>\n";
        $s .= "</tr>\n";

        // We need to work out what date to start at so that the first appears in the correct column
        $day = $this->startDay + 1 - $first;
        while ($day > 1) {
            $day -= 7;
        }

        // Make sure we know when today is, so that we can use a different CSS style
        $today = getdate(time());

        while ($day <= $daysInMonth) {
            $s .= "<tr>\n";

            for ($i = 0; $i < 7; $i++) {
                $tdbgcolor = $this->tdbgcolor;
                if ($this->selectedDay && $this->selectedDaysNo) {
                    if ($this->selectedDaysNo == 1) {
                        if ($this->selectedDay == $day)
                            $tdbgcolor = $this->selected_tdbgcolor;
                    } else {
                        if ($day - $i <= $this->selectedDay && $this->selectedDay < $day + (7 - $i)) {
                            if ($this->selectedDaysNo != 5 ||
                                ($this->selectedDaysNo == 5 &&
                                    ($this->startDay + $i) % 7 != 0 && ($this->startDay + $i) % 7 != 6)) {
                                $tdbgcolor = $this->selected_tdbgcolor;
                            }
                        }
                    }
                }

                $class = ($year == $today["year"] && $month == $today["mon"] && $day == $today["mday"]) ? (isset($events[$day]) ? "calendar_data_activa" : "calendar_data_inactiva") : (isset($events[$day]) ? "calendar_data_activa" : "calendar_data_inactiva");
                $s .= "<td class=\"$class\" align=\"center\" valign=\"middle\" bgcolor=\"$tdbgcolor\" width=\"28\" height=\"20\">";

                if ($day > 0 && $day <= $daysInMonth) {
                    $link = $this->getDateLink($day, $month, $year);

                    if ($tdbgcolor == $this->selected_tdbgcolor) {
                        $date = getdate(mktime(12, 0, 0, $month, $day, $year));
                        $humanedate['mday'] = $date["mday"];
                        $humanedate['weekday'] = $date["weekday"];
                        $humanedate['mon'] = $date["mon"];
                        $humanedate['year'] = $date["year"];
                        array_push($this->selectedDaysArr, $humanedate);
                    }

                    if (isset($this->formDetails['formno']) && isset($this->formDetails['fieldno'])) {
                        $onmouseclick = "onClick=\"closeCalWin($day,$month,$year,'" . $this->formDetails['formno'] . "','" . $this->formDetails['fieldno'] . "'); return false;\"";
                    } else {
                        $onmouseclick = "";
                    }

                    $s .= $year . ($month <= 9 ? '0' : '') . $month . ($day <= 9 ? '0' : '') . $day <= $curr_date ? "<a href=\"$mylink&year=$year&month=$month&day=$day\" class=\"calendar_data_activa\">$day</a>" : $day;
                } else {
                    /*
                    if($day <= 0)
                    {
                    $d = $daysInPrevMonth - abs($day);
                    $s .= "<font color=\"".$this->anothermonthcolor."\">" . $d . "</font>";
                    if($tdbgcolor == $this->selected_tdbgcolor)
                    {
                        $date = getdate(mktime(12, 0, 0, $prev[0], $d, $prev[1]));
                        $humanedate['mday'] = $date["mday"];
                        $humanedate['weekday'] = $date["weekday"];
                        $humanedate['mon'] = $date["mon"];
                        $humanedate['year'] = $date["year"];
                                    array_push($this->selectedDaysArr,$humanedate);
                    }
                    }
                    else
                    {
                    $d = $day - $daysInMonth;
                    $s .= "<font color=\"".$this->anothermonthcolor."\">" . $d . "</font>";
                    if($tdbgcolor == $this->selected_tdbgcolor)
                    {
                        $date = getdate(mktime(12, 0, 0, $next[0], $d, $next[1]));
                        $humanedate['mday'] = $date["mday"];
                        $humanedate['weekday'] = $date["weekday"];
                        $humanedate['mon'] = $date["mon"];
                        $humanedate['year'] = $date["year"];
                                    array_push($this->selectedDaysArr,$humanedate);
                    }
                    }
                    */
                    $s .= "&nbsp";
                }

                $s .= "</td>\n";
                $day++;
            }
            $s .= "</tr>\n";
        }

        if ($month <= 1) {
            $prevMonth = 12;
            $prevYear = $year - 1;
        } else {
            $prevMonth = $month - 1;
            $prevYear = $year;
        }

        if ($month >= 12) {
            $nextMonth = 1;
            $nextYear = $year + 1;
        } else {
            $nextMonth = $month + 1;
            $nextYear = $year;
        }

        $s .= "<tr>
	    	    <td height=\"20\" colspan=\"3\" bgcolor=\"#cccccc\"><a href=\"$mylink&year=$prevYear&month=$prevMonth\" class=\"calendar_data_inactiva\">&laquo;&nbsp;" . $this->monthNames[$prevMonth - 1] . "</a></td>
		    <td width=\"28\" height=\"20\" bgcolor=\"#cccccc\">&nbsp;</td>
		    <td height=\"20\" colspan=\"3\" bgcolor=\"#cccccc\" align=\"right\"><a href=\"$mylink&year=$nextYear&month=$nextMonth\" class=\"calendar_data_inactiva\">" . $this->monthNames[$nextMonth - 1] . "&nbsp;&raquo;</a></td>
	       </tr>";

        $s .= "</table>\n";

        return $s;
    }

    /*
	The URL to link to in order to display a calendar for a given month/year.
    */

    function adjustDate($month, $year)
    {
        $a = array();
        $a[0] = $month;
        $a[1] = $year;

        while ($a[0] > 12) {
            $a[0] -= 12;
            $a[1]++;
        }

        while ($a[0] <= 0) {
            $a[0] += 12;
            $a[1]--;
        }

        return $a;
    }

    /*
	Selected day in month
    */


    function getDaysInMonth($month, $year)
    {
        if ($month < 1 || $month > 12) {
            return 0;
        }

        $d = $this->daysInMonth[$month - 1];

        if ($month == 2) {
            // Check for leap year
            // Forget the 4000 rule, I doubt I'll be around then...

            if ($year % 4 == 0) {
                if ($year % 100 == 0) {
                    if ($year % 400 == 0) {
                        $d = 29;
                    }
                } else {
                    $d = 29;
                }
            }
        }

        return $d;
    }

    /*
	The selected days number in a week
    */

    function getCalendarLink($month, $year, $day = 0)
    {
        if ($this->calendarLink == "") return $this->calendarLink;
        if (strchr($this->calendarLink, "?"))
            return $this->calendarLink . "&day=" . $day . "&month=" . $month . "&year=" . $year;
        else
            return $this->calendarLink . "?day=" . $day . "&month=" . $month . "&year=" . $year;
    }

    /*
	The seected week days name
    */

    function setCalendarLink($link)
    {
        $this->calendarLink = $link;
    }

    /*
	Close window on mouse click and the mouse event 
    */

    function getDateLink($day, $month, $year)
    {
        if ($this->dateLink == "") return $this->dateLink;
        if (strchr($this->dateLink, "?")) {
            return $this->dateLink . "&day=" . $day . "&month=" . $month . "&year=" . $year;
        } else
            return $this->dateLink . "?day=" . $day . "&month=" . $month . "&year=" . $year;
    }

        function setDateLink($link)
    {
        $this->dateLink = $link;
    } //bgcolor for head td

    function getCurrentYearView()
    {
        $d = getdate(time());
        return $this->getYearView($d["year"], $d["mon"]);
    } //bgcolor for td

    function getYearView($year, $month = 0)
    {
        return $this->getYearHTML($year, $month);
    } //bgcolor for selected td

    function getYearHTML($year, $month = 0)
    {
        $s = "";
        $prev = $this->getCalendarLink($month, $year - 1);
        $next = $this->getCalendarLink($month, $year + 1);

        $s .= "<table class=\"calendar\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n";
        $s .= "<tr>";
        $s .= "<td valign=\"top\" align=\"left\">" . (($prev == "") ? "&nbsp;" : "<a href=\"$prev\"><img src=\"images/leftarrow2.gif\" width=\"10\" height=\"8\" border=\"0\"></a>") . "</td>\n";
        $s .= "<td colspan=\"2\" class=\"calendarHeader\" valign=\"top\" align=\"center\">" . (($this->startMonth > 1) ? $year . " - " . ($year + 1) : $year) . "</td>\n";
        $s .= "<td valign=\"top\" align=\"right\">" . (($next == "") ? "&nbsp;" : "<a href=\"$next\"><img src=\"images/rightarrow2.gif\" width=\"10\" height=\"8\" border=\"0\"></a>") . "</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(0 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(1 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(2 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(3 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(4 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(5 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(6 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(7 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(8 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(9 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(10 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "<td class=\"calendar\" valign=\"top\">" . $this->getMonthHTML(11 + $this->startMonth, $year, array(), 0) . "</td>\n";
        $s .= "</tr>\n";
        $s .= "</table>\n";

        return $s;
    } //the font color for prev and next month days
}

?>
