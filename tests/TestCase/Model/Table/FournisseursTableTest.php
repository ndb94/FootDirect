<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FournisseursTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FournisseursTable Test Case
 */
class FournisseursTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FournisseursTable
     */
    public $Fournisseurs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fournisseurs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Fournisseurs') ? [] : ['className' => 'App\Model\Table\FournisseursTable'];
        $this->Fournisseurs = TableRegistry::get('Fournisseurs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Fournisseurs);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
