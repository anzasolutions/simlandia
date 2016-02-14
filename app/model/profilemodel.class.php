<?php

/**
 * Business logic of profile.
 * @author anza
 * @version 03-04-2011
 */
class ProfileModel extends AbstractModel
{
	/**
	 * Perform delete operation on User.
	 * @param string $user
	 */
	public function delete(User $user)
	{
		return DAOFactory::getUserDAO()->delete($user);
	}
	
	// TODO: to be completed
	private function updateUserPassword(User $user)
	{
		if ($user != null)
		{
			// generate new password as random MD5 value
			
			// update user password with newly generated one
			$user->setPassword();
			DAOFactory::getUserDAO()->save($user);
		}
	}
	
	public function getUser($login)
	{
		return DAOFactory::getUserDAO()->findByLogin($login);
	}
	
//	//TODO: refactor if necessary and add comment
//	public function getLatestPhotoAdded()
//	{
//		$images = $this->imageDAO()->findLatest(30);
//		$latestPhotos = array();
//		
//		foreach ($images as $image)
//		{
//			array_push($latestPhotos, $image->getUserId());
//		}
//		$idSet = array_unique($latestPhotos);
//		$users = $this->getUserDAO()->findByIdSet($idSet);
//		$imageMap = array();
//	
//		foreach ($images as $image)
//		{
//			$singleMap = array();
//			foreach ($users as $user)
//			{
//				if ($image->getUserId() == $user->getId())
//				{
////					$imageMap[$user] = $image;
//					$singleMap = array($image, $user);
//				}
//			}
//			array_push($imageMap, $singleMap);
//		}
//		
//		return $imageMap;
//	}
}

?>