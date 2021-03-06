<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @method \App\Model\Entity\Article get($primaryKey, $options = [])
 * @method \App\Model\Entity\Article newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Article[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Article|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Article[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Article findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticlesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('articles');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('libelle');

        $validator
            ->allowEmpty('description');

        $validator
            ->numeric('prix')
            ->allowEmpty('prix');

        $validator
            ->allowEmpty('photo');

        $validator
            ->integer('id_club')
            ->allowEmpty('id_club');

        $validator
            ->integer('id_fournisseur')
            ->allowEmpty('id_fournisseur');

        $validator
            ->integer('stock_s')
            ->allowEmpty('stock_s');

        $validator
            ->integer('stock_m')
            ->allowEmpty('stock_m');

        $validator
            ->integer('stock_l')
            ->allowEmpty('stock_l');

        $validator
            ->integer('stock_xl')
            ->allowEmpty('stock_xl');

        $validator
            ->integer('stock_xxl')
            ->allowEmpty('stock_xxl');

        return $validator;
    }
}
