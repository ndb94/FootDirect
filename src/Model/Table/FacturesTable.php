<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Factures Model
 *
 * @method \App\Model\Entity\Facture get($primaryKey, $options = [])
 * @method \App\Model\Entity\Facture newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Facture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Facture|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Facture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Facture[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Facture findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FacturesTable extends Table
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

        $this->table('factures');
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
            ->integer('id_user')
            ->allowEmpty('id_user');

        $validator
            ->allowEmpty('commande');

        $validator
            ->numeric('prix_total')
            ->allowEmpty('prix_total');

        return $validator;
    }
}
