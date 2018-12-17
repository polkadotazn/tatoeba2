<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TagsSentencesTable;
use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class TagsSentencesTableTest extends TestCase {
    public $fixtures = array(
        'app.tags_sentences'
    );

    function setUp() {
        parent::setUp();
        Configure::write('Acl.database', 'test');
        $this->TagsSentences = TableRegistry::getTableLocator()->get('TagsSentences');
    }

    function tearDown() {
        unset($this->TagsSentences);
        parent::tearDown();
    }

    function testSphinxAttributesChanged() {
        $expectedValues = array(8 => array(array(1, 3)));
        $entity = $this->TagsSentences->get(1);
        $this->TagsSentences->sphinxAttributesChanged($attrs, $values, $isMVA, $entity);
        $this->assertTrue($isMVA);
        $this->assertEquals(array('tags_id'), $attrs);
        $this->assertEquals($expectedValues, $values);
    }

    function testTagSentence_succeeds() {
        $result = $this->TagsSentences->tagSentence(1, 1, 1);
        $this->assertTrue($result);
    }

    function testTagSentence_failsBecauseAlreadyAdded() {
        $result = $this->TagsSentences->tagSentence(2, 2, 1);
        $this->assertFalse($result);
    }
}
