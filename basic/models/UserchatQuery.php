<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Userchat]].
 *
 * @see Userchat
 */
class UserchatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Userchat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Userchat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
