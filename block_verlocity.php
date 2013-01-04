<?php

class block_verlocity extends block_base{
    public function init(){
        $this->title = get_string('verlocity', 'block_verlocity');
    }
    
    public function get_content() {
    if ($this->content !== null) {
      return $this->content;
    }
 
    $this->content         =  new stdClass;
    $verlocity = $this->calculate_verlocity();
    $this->content->text   = 'Total courses completed '.$verlocity['total'].'<br>Enrolled this year '.$verlocity['year'].'<br>Enrolled this month '.$verlocity['month'].'<br>Enrolled this week '.$verlocity['week'];
    $this->content->footer = 'Footer here...';
 
    return $this->content;
  }
  
  private function calculate_verlocity(){
    global $DB, $USER;
    $sql = 'select * from {course_completions} where userid = :userid';
    $params = array('userid' => $USER->id);
    $comp_records = $DB->get_records_sql($sql,$params);
    $year = 0;
    $month = 0;
    $week = 0;
    echo time() - (365 * 24 * 60 * 60);
    foreach($comp_records as $r){
        echo 'hey hey';
        $time_enrolled = $r->timeenrolled;
        if($time_enrolled > (time() - (365 * 24 * 60 * 60))){
            $year++;
            if($time_enrolled > (time() - (30 * 12 * 60 * 60))){
                $month++;
                if($time_enrolled > (time() - (7 * 24 * 60 * 60))){
                    $week++;
                }
            }
        }
        
    }
    $verlocity = array('total'=>sizeof($comp_records), 'year'=>$year, 'month'=>$month, 'week'=>$week);
    return $verlocity;
    
  }
  
  
}   // Here's the closing bracket for the class definition



