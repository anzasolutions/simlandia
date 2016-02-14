<?php

/**
 * Video persistance gateway.
 * @author anza
 * @version 09-08-2011
 */
class VideoDAO extends DAO
{
	public function findLatestForUser($limit, $profileId)
	{
		$subQuery = $this->db->query();
		$subQuery->select('id')->from('User');
		$subQuery->where('login', $profileId);
		$query = $this->simpleSelect();
		$query->where('userid', $subQuery, Query::IN)->orderBy('added')->desc()->limit(0, $limit);
		return $this->result($query);
	}
	
	public function findLatest($limit)
	{
		$query = $this->simpleSelect();
		$query->orderBy('added')->desc()->limit(0, $limit);
		return $this->result($query);
	}
}

?>