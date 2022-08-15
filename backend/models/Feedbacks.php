<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedbacks".
 *
 * @property int $id
 * @property string $title
 * @property string|null $text
 * @property int $books_id
 * @property int $status
 * @property string $name
 *
 * @property Books $books
 */
class Feedbacks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedbacks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'books_id', 'status', 'name'], 'required'],
            [['books_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['text'], 'string', 'max' => 500],
            [['name'], 'string', 'max' => 255],
            [['books_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::className(), 'targetAttribute' => ['books_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'books_id' => 'Books ID',
            'status' => 'Status',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasOne(Books::className(), ['id' => 'books_id']);
    }
}
