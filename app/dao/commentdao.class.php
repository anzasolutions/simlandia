<?php

/**
 * Interacts with Comment table.
 * @author anza
 * @version 27-06-2011
 */
class CommentDAO extends DAO
{
	public function findByTypeAndTypeId($type, $typeId)
	{
		$query = $this->simpleSelect();
		$query->where('type', $type)->add('typeId', $typeId)->orderBy('date')->desc();
		return $this->result($query);
	}
	
	public function findByTypeAndTypeIdAndLimit($type, $typeId, $position, $limit)
	{
		$query = $this->simpleSelect();
		$query->where('type', $type)->add('typeId', $typeId)->orderBy('date')->desc()->limit($position, $limit);
		return $this->result($query);
	}
	
	public function countByTypeAndTypeId($type, $typeId)
	{
		$query = $this->simpleSelect();
		$query->where('type', $type)->add('typeId', $typeId);
		return $this->count($query);
	}
}

?>