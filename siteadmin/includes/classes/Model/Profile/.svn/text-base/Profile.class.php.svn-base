<?php
class Model_Base_Profile
{
    private $mDb;

    /** instant messangers */
    private $mTbUsersIm;

    /** relations */
    private $mTbUsersFamily;

    /** spoken languages */
    private $mTbUsersLang;

    /** users mission */
    private $mTbUsersMission;

    /** users callings */
    private $mTbUsersCalling;

    /** user interests */
    private $mTbUsersInterest;

    /** user jobs */
    private $mTbUsersJob;

    /** user university */
    private $mTbUsersUniversity;

    /** user high school */
    private $mTbUsersHSchool;

    /** callings */
    private $mTbCallings;

    /** SchoolClasses */
    private $mTbClasses;

    /** SchoolClasses */
    private $mTbUsersClasses;

    public function __construct( &$gDb )
    {
        $this -> mDb =& $gDb;
        /** users tables */
        $this -> mTbUsers           = TB . 'users';
        $this -> mTbUsersIm         = TB . 'users_im';
        $this -> mTbUsersFamily     = TB . 'users_family';
        $this -> mTbUsersLang       = TB . 'users_langs';
        $this -> mTbUsersMission    = TB . 'users_mission';
        $this -> mTbMissionSubscr   = TB . 'mission_subscr';
        $this -> mTbUsersCalling    = TB . 'users_calling';
        $this -> mTbUsersInterest   = TB . 'users_interest';
        $this -> mTbUsersUniversity = TB . 'users_university';
        $this -> mTbUsersHSchool    = TB . 'users_hschool';
        $this -> mTbUsersJob        = TB . 'users_job';
        $this -> mTbClasses         = TB . 'classes';
        $this -> mTbUsersClasses    = TB . 'users_classes';

        /** callings for autocomplete */
        $this -> mTbCallings        = TB . 'callings';
    }


    /**
     * Edit instant messangers for user
     * @param int $uid
     * @param int $im_type
     * @param string $im_name
     * @return bool true
     */
    public function EditIm($uid, $im_type, $im_name, $id = 0)
    {
        $sql = 'INSERT INTO '.$this -> mTbUsersIm.' (uid, im_type, im_name)
                VALUES(?, ?, ?)';
        $this -> mDb -> query($sql, array($uid, $im_type, $im_name));

        return true;
    }/** EditIm */


    /**
     * Clear IM list
     * @param int $uid
     */
    public function ClearIm($uid)
    {
        $sql = 'DELETE FROM '.$this->mTbUsersIm.' WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/** ClearIm */


    /**
     * Get Im list
     * @param int $uid - user ID
     * @return array
     */
    public function GetImList($uid)
    {
        $sql = 'SELECT im_type, im_name FROM '.$this -> mTbUsersIm.' WHERE uid = ?';
        $db  = $this -> mDb -> query($sql, array($uid));
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/** GetImList */




    public function ChkFamily($uid, $wuid)
    {
        $ex = $this -> mDb -> getOne('SELECT uid FROM '.$this -> mTbUsersFamily.' WHERE uid = ? AND wuid = ?', array( $uid, $wuid ));
        if ($ex)
            return 1;
        else
            return 0;
    }/* ChkFamily */

    /**
     * Edit family for users
     * @param $uid
     * @param $rel_status
     * @param $name
     * @return bool true
     */
    public function EditFamily($uid, $rel_status, $wname, $wuid, $id = 0)
    {
        $sql = 'INSERT INTO '.$this -> mTbUsersFamily.' (uid, wuid, name, rel_status)
                VALUES(?, ?, ?, ?)';
        $this -> mDb -> query($sql, array($uid, $wuid, $wname, $rel_status));
        return true;
    }/** EditFamily */


    /**
     * Clear family list
     * @param int $uid
     */
    public function ClearFamily($uid)
    {
        $sql = 'DELETE FROM '.$this->mTbUsersFamily.' WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/** ClearFamily */


    /**
     * Get family list
     * @param int $uid - user ID
     * @return array
     */
    public function GetFamilyList($uid, $only_list = 0, $as_assoc = 0)
    {
        if (!$only_list)
        {
            $sql = 'SELECT uf.*, u.first_name, u.last_name, u.image, u.last_access, u.fpath, u.country, u.city
        		FROM '.$this -> mTbUsersFamily.' uf  
        		LEFT JOIN '.$this -> mTbUsers.' u ON ( u.uid = uf.wuid ) WHERE uf.uid = ?';
        }
        else
        {
            $sql = 'SELECT * FROM '.$this -> mTbUsersFamily.' WHERE uid = ?';
        }
        $db  = $this -> mDb -> query($sql, array($uid));
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            if ($as_assoc)
            {
                $r[$row['wuid']] = $row;
            }
            else
            {
                $r[] = $row;
            }
        }
        return $r;
    }/** GetFamilyList */


    /**
     * Edit spoken languages for users
     * @param $uid
     * @param $lang_id
     * @return bool true
     */
    public function EditLang($uid, $lang_id)
    {
        $sql = 'INSERT INTO '.$this -> mTbUsersLang.' (uid, lang_id)
               VALUES(?, ?)';
        $this -> mDb -> query($sql, array($uid, $lang_id));

        return true;
    }/** EditFamily */

    /**
     * Clear languages list
     * @param int $uid
     */
    public function ClearLang($uid)
    {
        $sql = 'DELETE FROM '.$this->mTbUsersLang.' WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/** ClearLang */


    /**
     * Get spoken languages list
     * @param int $uid - user ID
     * @return array
     */
    public function GetLangList($uid)
    {
        $sql = 'SELECT lang_id FROM '.$this -> mTbUsersLang.' WHERE uid = ?';
        $db  = $this -> mDb -> query($sql, array($uid));
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row['lang_id'];
        }
        return $r;
    }/** GetLangList */


    /**
     * Edit missions for user
     * @param int $uid
     * @param string $fdate
     * @param string $tdate
     * @param string $location
     * @return bool true
     */
    public function EditMission($uid, $fdate, $tdate, $location, $mid = 0, $umid = 0 )
    {
        if($umid)
        {
            $sql = "UPDATE " . $this->mTbUsersMission . " SET fdate = ?, tdate = ?, location = ?, mid = ? WHERE uid = ? AND id = ?";
            $db = $this->mDb->query($sql, array($fdate, $tdate, $location, $mid, $uid, $umid));
            return 2;
        }
        else
        {
            $sql = 'INSERT INTO ' . $this->mTbUsersMission . ' (uid, fdate, tdate, location, mid)
                        VALUES(?, ?, ?, ?, ?)';
            $db = $this->mDb->query($sql, array($uid, $fdate, $tdate, $location, $mid));

            $mid = $this->mDb->GetOne('SELECT LAST_INSERT_ID()');

            if($mid)
            {
                /** update users mission subscr */
                /*
                $sql = 'INSERT INTO '.$this -> mTbMissionSubscr.'(mission_id, uid, dt) VALUES(?, ? , NOW())';
                $this -> mDb -> query($sql, array($mid, $uid));
                */
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }/** EditIm */

    public function DelAllM( $uid )
    {
        /** update users mission */
        $sql = 'DELETE FROM '.$this -> mTbUsersMission.' WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));

        /** update users mission subscr */
        $sql = 'DELETE FROM '.$this -> mTbMissionSubscr.' WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));
    }/** Del */
    public function DelMission( $uid , $umid )
    {
        /** update users mission */
        $sql = 'DELETE FROM '.$this -> mTbUsersMission.' WHERE uid = ? AND id = ?';
        $this -> mDb -> query($sql, array($uid, $umid));

        /** update users mission subscr */
        $sql = 'DELETE FROM '.$this -> mTbMissionSubscr.' WHERE uid = ? AND mission_id = ?';
        $this -> mDb -> query($sql, array($uid, $umid));
    }/** Del */


    /**
     * Clear Missions list
     * @param int $uid
     */
    public function ClearMission($uid, $mid = -1)
    {
        $sql = 'DELETE FROM '.$this->mTbUsersMission.' WHERE uid = ? ';
        if (-1 != $mid)
            $sql .= ' AND mid = '.$mid;
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/** ClearMission */


    /**
     * Get Missions list
     * @param int $uid - user ID
     * @return array
     */
    public function GetMissionList($uid)
    {
        $sql = 'SELECT fdate, tdate, location, id FROM '.$this -> mTbUsersMission.' WHERE uid = ?';
        $db  = $this -> mDb -> query($sql, array($uid));
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/** GetMissionList */

    /**
     * Get Ward Id
     */
    public function GetWardId($uid)
    {
        $sql = 'SELECT ward_id FROM '.$this -> mTbUsers.' WHERE uid = ?';
        $ward_id  = (int)$this -> mDb -> GetOne($sql, array($uid));
        return $ward_id;
    }

    /**
     * Get Stake Id
     */
    public function GetStakeId($uid)
    {
        $sql = 'SELECT stake_id FROM '.$this -> mTbUsers.' WHERE uid = ?';
        $stake_id  = (int)$this -> mDb -> GetOne($sql, array($uid));
        return $stake_id;
    }


    /**
     * Edit Calling for user
     * @param int $uid
     * @param string $calling
     * @return bool true
     */
    public function EditCalling($uid, $calling, $comment)
    {
        $sql = 'INSERT INTO '.$this -> mTbUsersCalling.' (uid, calling, comment)
                VALUES(?, ?, ?)';
        $this -> mDb -> query($sql, array($uid, $calling, $comment));
        return true;
    }/** EditCalling */


    /**
     * Clear Missions list
     * @param int $uid
     */
    public function ClearCalling($uid)
    {
        $sql = 'DELETE FROM '.$this->mTbUsersCalling.' WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/** ClearCalling */


    /**
     * Get Callings list
     * @param int $uid - user ID
     * @return array
     */
    public function GetCallingList($uid)
    {
        $sql = 'SELECT calling, comment FROM '.$this -> mTbUsersCalling.' WHERE uid = ?';
        $db  = $this -> mDb -> query($sql, array($uid));
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/** GetCallingList */


    /**
     * Edit Interest for user
     * @param int $uid
     * @param int $num - interest number or 0 for non-standart
     * @param string $title
     * @param string $story
     * @return bool true
     */
    public function EditInterest($uid, $num, $title, $story)
    {
        $sql = 'INSERT INTO '.$this -> mTbUsersInterest.' (uid, num, title, story)
                VALUES(?, ?, ?, ?)';
        $this -> mDb -> query($sql, array($uid, $num, $title, $story));
        return true;
    }/** EditInterest */


    /**
     * Clear Interests list
     * @param int $uid
     */
    public function ClearInterest($uid)
    {
        $sql = 'DELETE FROM '.$this->mTbUsersInterest.' WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/** ClearInterest */


    /**
     * Get Interests list
     * @param int $uid - user ID
     * @return array
     */
    public function GetInterestList($uid)
    {
        $sql = 'SELECT * FROM '.$this -> mTbUsersInterest.' WHERE uid = ?';
        $db  = $this -> mDb -> query($sql, array($uid));
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/** GetInterestList */




    /**
     * Edit University for user
     * @param int $uid
     * ...
     * @return bool true
     */
    public function EditUniversity($uid, $university, $cyear, $cyear2, $major, $minor)
    {
        $sql = 'INSERT INTO '.$this -> mTbUsersUniversity.' (uid, university, cyear, cyear2, major, minor)
                VALUES(?, ?, ?, ?, ?, ?)';
        $this -> mDb -> query($sql, array($uid, $university, $cyear, $cyear2, $major, $minor));
        return true;
    }/** EditUniversity */


    /**
     * Clear Interests list
     * @param int $uid
     */
    public function ClearUniversity($uid)
    {
        $sql = 'DELETE FROM '.$this->mTbUsersUniversity.' WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/** ClearUniversity */


    /**
     * Get Interests list
     * @param int $uid - user ID
     * @return array
     */
    public function GetUniversityList($uid)
    {
        $sql = 'SELECT * FROM '.$this -> mTbUsersUniversity.' WHERE uid = ?';
        $db  = $this -> mDb -> query($sql, array($uid));
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/** GetUniversityList */




    /**
     * Edit High School for user
     * @param int $uid
     * ...
     * @return bool true
     */
    public function EditHSchool($uid, $hschool, $hyear, $hyear2)
    {
        $sql = 'INSERT INTO '.$this -> mTbUsersHSchool.' (uid, hschool, hyear, hyear2)
                VALUES(?, ?, ?, ?)';
        $this -> mDb -> query($sql, array($uid, $hschool, $hyear, $hyear2));
        return true;
    }/** EditHSchool */


    /**
     * Clear High School list
     * @param int $uid
     */
    public function ClearHSchool($uid)
    {
        $sql = 'DELETE FROM '.$this->mTbUsersHSchool.' WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/** ClearInterest */


    /**
     * Get High school list
     * @param int $uid - user ID
     * @return array
     */
    public function GetHSchoolList($uid)
    {
        $sql = 'SELECT * FROM '.$this -> mTbUsersHSchool.' WHERE uid = ?';
        $db  = $this -> mDb -> query($sql, array($uid));
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/** GetHSchoolList */


    /**
     * Edit Job for user
     * @param int $uid
     * ...
     * @return bool true
     */
    public function EditJob($uid, $estatus, $employer, $pos, $descr, $city, $fmonth, $fyear, $present, $tmonth, $tyear)
    {
        $sql = 'INSERT INTO '.$this -> mTbUsersJob.' (uid, estatus, employer, pos, descr, city, fmonth, fyear, present, tmonth, tyear)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $this -> mDb -> query($sql, array($uid, $estatus, $employer, $pos, $descr, $city, $fmonth, $fyear, $present, $tmonth, $tyear));
        return true;
    }/** EditJob */


    /**
     * Clear Job list
     * @param int $uid
     */
    public function ClearJob($uid)
    {
        $sql = 'DELETE FROM '.$this->mTbUsersJob.' WHERE uid = ?';
        $this -> mDb -> query($sql, array($uid));
        return true;
    }/** ClearJob */


    /**
     * Get Job list
     * @param int $uid - user ID
     * @return array
     */
    public function GetJobList($uid)
    {
        $sql = 'SELECT * FROM '.$this -> mTbUsersJob.' WHERE uid = ?';
        $db  = $this -> mDb -> query($sql, array($uid));
        $r   = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/** GetJobList */


    /**************************************************
              Callings
     **************************************************/

    /**
     * Edit callings
     * @param int $uid
     * @param string $title - calling
     * @param int $id
     * @return bool true
     */
    public function EditCallings($uid, $title, $id = 0)
    {
        if (!$id)
        {
            $sql = 'INSERT INTO '.$this -> mTbCallings.' (title)
                VALUES( ? )';
            $this -> mDb -> query($sql, array($title));
        }
        else
        {
            $sql = 'UPDATE '.$this -> mTbCallings.' SET
                    title = ?
                    WHERE id = ?';
            $this -> mDb -> query($sql, array($title, $id));
        }
        return true;
    }/** EditCallings */


    public function GetCallingsList( $str = '' )
    {
        $sql = 'SELECT * FROM '.$this -> mTbCallings.' WHERE 1';
        $sql = trim(mysql_escape_string($str));

        if ($str)
        {
            $sql .= ' AND title LIKE "'.$str.'%"';
        }
        $db = $this -> mDb -> query($sql);
        $r  = array();
        while ($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }/** GetCallingsList */


    public function GetSchoolClassList($uid, $wid, $as_assoc = 0)
    {
        $sql = "SELECT * FROM ".$this -> mTbClasses." c LEFT JOIN ".$this -> mTbUsersClasses." uc ON (uc.class_id = c.id) WHERE uc.uid = ? AND c.wid = ?";
        $db = $this -> mDb -> query($sql, array($uid, $wid));
    
        $r = array();
        while($row = $db -> FetchRow())
        {
            if (!$as_assoc)
            {
                $r[] = $row;
            }
            elseif (2==$as_assoc)
            {
                $r[$row['class_id']] = $row['title'];
            }
            else
            {
                $r[] = $row['id'];
            }
         
        }
        return $r;
    }

    
    public function SearchSchoolClass($q, $ward_id)
    {
        $sql = "SELECT title FROM ".$this -> mTbClasses." WHERE title LIKE ? AND wid=?";
        $db = $this -> mDb -> query($sql, array($q.'%', $ward_id));
        $r = array();
        while($row = $db -> FetchRow())
        {
            $r[] = $row;
        }
        return $r;
    }


    public function GetSchoolClassByName($title, $wid)
    {
        $sql = "SELECT id FROM ".$this -> mTbClasses." WHERE title = ? AND wid = ?";
        return (int) $this -> mDb -> getOne($sql, array($title, $wid));
    }


    public function EditSchoolClass($title, $wid, $id = 0)
    {
        $id = (int)$id;
        $wid = (int)$wid;
        
        if($id)
        {
            $sql = "UPDATE ".$this -> mTbClasses." SET title = ? AND wid = ? WHERE id = ?";
            $this -> mDb -> query($sql, array($title, $wid, $id));
        }
        else
        {
            $sql = "INSERT INTO ".$this -> mTbClasses."(title, wid, pdate) VALUES(?, ?, NOW())";
            $this -> mDb -> query($sql, array($title, $wid));
            $id = (int) $this -> mDb -> getOne("SELECT LAST_INSERT_ID() FROM ".$this -> mTbClasses);
        }

        return $id;
    }


    public function EditUserSchoolClass($class_id, $id, $uid)
    {
        $class_id = (int)$class_id;
        $id = (int)$id;
        $uid = (int)$uid;

        if($id)
        {
            $sql = "UPDATE ".$this -> mTbUsersClasses." SET class_id = ? WHERE id = ? AND uid = ?";
            $this -> mDb -> query($sql, array($class_id, $id, $uid));
        }
        else
        {
            $sql = "INSERT INTO ".$this -> mTbUsersClasses."(class_id, uid, pdate) VALUES(?, ?, NOW())";
            $this -> mDb -> query($sql, array($class_id, $uid));
            $id = (int) $this -> mDb -> getOne("SELECT LAST_INSERT_ID() FROM ".$this -> mTbUsersClasses);
        }
        return $id;
    }

    
    public function DelUserSchoolClass($id, $uid)
    {
        $sql = "DELETE FROM ".$this -> mTbUsersClasses." WHERE id = ? AND uid = ?";
        $this -> mDb -> query($sql, array($id, $uid));
    }
}/** Model_Base_Profile */
?>