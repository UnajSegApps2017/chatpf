<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Newchat]].
 *
 * @see Newchat
 */
class MessageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Newchat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Newchat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
