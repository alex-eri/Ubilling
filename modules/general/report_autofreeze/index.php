<?php
if (cfr('REPORTAUTOFREEZE')) {
    
    class ReportAutoFreeze {
        
        private $data =array();
        private $interval='';
        
        public function __construct($date='') {
            //load actual data
            $this->loadData($date);
            //sets default calendar position
            $this->interval=$date;
        }
        
        /*
         * parse data from system weblog and store it into private property
         * 
         * @return void
         */
        private function loadData($date='') {
            if (!empty($date)) {
                $wherePostfix=" AND `date` LIKE '".$date."%';";
            } else {
                $wherePostfix=' LIMIT 50;';
            }
            $query="SELECT * from `weblogs` WHERE `event` LIKE 'AUTOFREEZE (%'".$wherePostfix;
            $alldata=  simple_queryall($query);

            if (!empty($alldata)) {
                foreach ($alldata as $io=>$each) {
                    $this->data[$each['id']]['id']=$each['id'];
                    $this->data[$each['id']]['date']=$each['date'];
                    $this->data[$each['id']]['admin']=$each['admin'];
                    $this->data[$each['id']]['ip']=$each['ip'];
                    
                    $parse=  explode(' ',$each['event']);

                    //all elements available
                    if (sizeof($parse)==5) {
                        $userLogin=str_replace('(', '', $parse[1]);
                        $userLogin=str_replace(')', '', $userLogin);
                        $userBalance=$parse[4];
                        $this->data[$each['id']]['login']=$userLogin;
                        $this->data[$each['id']]['balance']=$userBalance;
                    }
              
                }
            }
        }
        
        
        /*
         * returns private propert data
         * 
         * @return array
         */
        public function getData () {
            $result=  $this->data;
            return ($result);
        }
        
        /*
         * renders autofreeze report by existing private data prop
         * 
         * @return string
         */
        public function render() {
            $allAddress=  zb_AddressGetFulladdresslist();
            $allRealNames= zb_UserGetAllRealnames();
            
            $cells=  wf_TableCell(__('ID'));
            $cells.= wf_TableCell(__('Date'));
            $cells.= wf_TableCell(__('Login'));
            $cells.= wf_TableCell(__('Address'));
            $cells.= wf_TableCell(__('Real Name'));
            $cells.= wf_TableCell(__('Cash'));
            $rows=  wf_TableRow($cells, 'row1');
            
            if (!empty($this->data)) {
                foreach ($this->data as $io=>$each) {
                    $cells=  wf_TableCell($each['id']);
                    $cells.= wf_TableCell($each['date']);
                    $loginLink=  wf_Link("?module=userprofile&username=".$each['login'], web_profile_icon().' '.$each['login'], false, '');
                    $cells.= wf_TableCell($loginLink);
                    $cells.= wf_TableCell(@$allAddress[$each['login']]);
                    $cells.= wf_TableCell(@$allRealNames[$each['login']]);
                    $cells.= wf_TableCell($each['balance']);
                    $rows.=  wf_TableRow($cells, 'row3');
                }
            }
            $result=  wf_TableBody($rows, '100%', '0', 'sortable');
            return ($result);
        }
        
        /*
         * renders form for date selecting
         * 
         * @return string
         */
        public function dateForm() {
            $inputs= wf_DatePickerPreset('date',  $this->interval);
            $inputs.= __('By date').' ';
            $inputs.= wf_Submit(__('Show'));
            $result=  wf_Form("", 'POST', $inputs, 'glamour');
            return ($result);
        }
        
    }
    
    
    
    $datePush= (wf_CheckPost(array('date'))) ? $dateSelector=$_POST['date'] :  $dateSelector='';
    $autoFreezeReport = new ReportAutoFreeze($dateSelector);
    show_window('', $autoFreezeReport->dateForm());
    show_window(__('Autofreeze report'),$autoFreezeReport->render());
    
} else {
      show_error(__('You cant control this module'));
}