<?php
 
namespace common\overrides\filter;

class AccessRule extends \yii\filters\AccessRule
{
    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        if (in_array('?', $this->roles) && $user->getIsGuest()) {
            return true;
        }
        if (in_array('@', $this->roles) && !$user->getIsGuest()) {
            return true;
        }
        if (!$user->getIsGuest() && in_array($user->identity->role, $this->roles)) {
            return true;
        }
        return false;
    }
}
