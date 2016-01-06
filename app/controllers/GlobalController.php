<?php

class GlobalController extends PublicController
{
    public function setUserEntityTheme($file, $dataarr)
    {
        $getpersonalcount = DB::table('tbl_bankaccounts')
            ->leftjoin('tbl_bankbranches', 'bankaccount_branch', '=', 'branch_id')
            ->leftjoin('tbl_banks', 'branch_bankid', '=', 'bank_id')
            ->where('bank_isproduct', '0')
            ->where('bankaccount_userentity', 'Personal')
            ->where('bankaccount_createdby', Auth::user()->id)
            ->count();
        $getbusinesscount = DB::table('tbl_bankaccounts')
            ->leftjoin('tbl_bankbranches', 'bankaccount_branch', '=', 'branch_id')
            ->leftjoin('tbl_banks', 'branch_bankid', '=', 'bank_id')
            ->where('bank_isproduct', '0')
            ->where('bankaccount_userentity', 'Business')
            ->where('bankaccount_createdby', Auth::user()->id)
            ->count();
        $resultbViewAcctype = DB::table('tbl_bankaccounttypes')->get();
        $resultbViewAcctypearr = array();
        foreach ($resultbViewAcctype as $data) {
            $resultbViewAcctypearr[$data->accounttype_id] = $data->accounttype_name;
        }
        $resultbViewBanks = DB::table('tbl_banks')
            ->where('bank_isproduct', 0)
            ->where('bank_status', '1')
            ->orderBy('bank_name', 'ASC')
            ->get();

        $resultbViewBanksarr = array();
        foreach ($resultbViewBanks as $data) {
            $resultbViewBanksarr[$data->bank_id] = $data->bank_name;
        }
        $resultbViewBankbranchs = DB::table('tbl_bankbranches')
            ->where("branch_bankid", key($resultbViewBanksarr))
            ->where("branch_status", "1")
            ->get();
        $resultbViewBankBrancharr = array();
        foreach ($resultbViewBankbranchs as $data) {
            $resultbViewBankBrancharr[$data->branch_id] = $data->branch_name;
        }

        if ($getpersonalcount <= 0 and $getbusinesscount <= 0) {
            $data = array(
                'bankaccttype' => $resultbViewAcctypearr,
                'bankname' => $resultbViewBanksarr,
                'bankbranch' => $resultbViewBankBrancharr
            );
            $MyTheme = Theme::uses('fonebayad')->layout('ezibills_9_0');
            return $MyTheme->of('registration.firstloginaddbankacct', $data)->render();

        } else {
//            $MyTheme = Theme::uses('fonebayad')->layout('ezibills_9_0');
            $MyTheme = Theme::uses('fonebayad')->layout('newDefault_myBills');
            return $MyTheme->of($file, $dataarr)->render();
        }
    }

    /**
     * This method fecth value for the datatables.
     *
     * @param none
     *
     * @return array json
     */

    public static function setDatatable($cQryObj, $aColumns = array(), $sIndexColumn = "")
    {
        $Sortdir=Input::get('sSortDir_0');
        $iDisplayStart   = Input::get('iDisplayStart');
        $iDisplayLength = Input::get('iDisplayLength');
        $iSortCol   = Input::get('iSortCol_0');
        $iSortingCols = Input::get('iSortingCols');
        $sSearch    = Input::get('sSearch');

        $sLimit = "";
        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $sLimit = $iDisplayStart.", ".$iDisplayLength;
        }

        $sOrder = "";
        if (isset($iSortCol)) {
            $field=$aColumns[$iSortCol];
        }

        $sWhere = "";
        if ($sSearch != "") {
            for ($i=0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i]."*".$sSearch."|";
            }
        }

        for ($i=0; $i < count($aColumns); $i++) {
            if (Input::get('bSearchable_'.$i) == "true" && Input::get('sSearch_'.$i) != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere = "AND ";
                }
                $sWhere .= $aColumns[$i].", ".Input::get('sSearch_'.$i);
            }
        }

        $order_by = explode(",", $sOrder);
        $limits  = explode(",", $sLimit);
        $filter  = explode("|", $sWhere);

        $cQryObjOrig = clone $cQryObj;
        $cQryObjTemp = clone $cQryObj;

        if ($sWhere != "") {
            $cQryObjTemp->where(function($query) use ($i, $filter, $cQryObjTemp, $cQryObjOrig) {
                for ($i=0; $i < count($filter) -1; $i++) {
                    $xFilter = explode("*", $filter[$i]);
                    if($i == 0) {
                        $cQryObjTemp = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%');
                        $cQryObjOrig = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%');
                    } else {
                        $cQryObjTemp = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%', 'OR');
                        $cQryObjOrig = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%', 'OR');
                    }
                }
            });
            $cQryObjOrig->where(function($query) use ($i, $filter, $cQryObjTemp, $cQryObjOrig) {
                for ($i=0; $i < count($filter) -1; $i++) {
                    $xFilter = explode("*", $filter[$i]);
                    if($i == 0) {
                        $cQryObjTemp = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%');
                        $cQryObjOrig = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%');
                    } else {
                        $cQryObjTemp = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%', 'OR');
                        $cQryObjOrig = $query->where($xFilter[0], 'LIKE', '%'.$xFilter[1].'%', 'OR');
                    }
                }
            });
        }

        $cQryObjResult  = $cQryObjTemp->orderBy($field,$Sortdir)->get();

        $output = array(
            "sEcho"                 => intval(Input::get('sEcho')),
            "iTotalRecords"         => $cQryObjOrig->count(),
            "iTotalDisplayRecords"  => $cQryObjOrig->count(),
            "aaData"                => array(),
            'objResult'             => $cQryObjResult,
        );

        return $output;
    }







}
