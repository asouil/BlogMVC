<?php
require_once "bob.php";
use PHPUnit\Framework\TestCase;

class BobTest extends TestCase
{
    /**
     * @var \Bob
     */
    private $bob;
    public function setUp(): void
    {
        $this->bob = new Bob;
    }
    public function testStatingSomething()
    {
        $this->assertEquals("Whatever.", $this->bob->respondTo("Tom-ay-to, tom-aaaah-to."));
    }
    public function testShouting()
    {
        $this->assertEquals("Whoa, chill out!", $this->bob->respondTo("WATCH OUT!"));
    }
    public function testShoutingGibberish()
    {
        $this->assertEquals("Whoa, chill out!", $this->bob->respondTo("FCECDFCAAB"));
    }
    public function testAskingAQuestion()
    {
        $this->assertEquals("Sure.", $this->bob->respondTo("Does this cryogenic chamber make me look fat?"));
    }
    public function testAskingANumericQuestion()
    {
        $this->assertEquals("Sure.", $this->bob->respondTo("You are, what, like 15?"));
    }
    public function testAskingGibberish()
    {
        $this->assertEquals("Sure.", $this->bob->respondTo("fffbbcbeab?"));
    }
    public function testTalkingForcefully()
    {
        $this->assertEquals("Whatever.", $this->bob->respondTo("Let's go make out behind the gym!"));
    }
    public function testUsingAcronymsInRegularSpeech()
    {
        $this->assertEquals("Whatever.", $this->bob->respondTo("It's OK if you don't want to go to the DMV."));
    }
    public function testForcefulQuestion()
    {
        $this->assertEquals("Whoa, chill out!", $this->bob->respondTo("WHAT THE HELL WERE YOU THINKING?"));
    }
    public function testShoutingNumbers()
    {
        $this->assertEquals("Whoa, chill out!", $this->bob->respondTo("1, 2, 3 GO!"));
    }
    public function testOnlyNumbers()
    {
        $this->assertEquals("Whatever.", $this->bob->respondTo("1, 2, 3"));
    }
    public function testQuestionWithOnlyNumbers()
    {
        $this->assertEquals("Sure.", $this->bob->respondTo("4?"));
    }
    public function testShoutingWithSpecialCharacters()
    {
        $this->assertEquals("Whoa, chill out!", $this->bob->respondTo("ZOMG THE %^*@#$(*^ ZOMBIES ARE COMING!!11!!1!"));
    }
    public function testShoutingWithNoExclamationMark()
    {
        $this->assertEquals("Whoa, chill out!", $this->bob->respondTo("I HATE YOU"));
    }
    public function testStatementContainingQuestionMark()
    {
        $this->assertEquals("Whatever.", $this->bob->respondTo("Ending with ? means a question."));
    }
    public function testNonLettersWithQuestion()
    {
        $this->assertEquals("Sure.", $this->bob->respondTo(":) ?"));
    }
    public function testPrattlingOn()
    {
        $this->assertEquals("Sure.", $this->bob->respondTo("Wait! Hang on. Are you going to be OK?"));
    }
    public function testSilence()
    {
        $this->assertEquals("Fine. Be that way!", $this->bob->respondTo(""));
    }
    public function testProlongedSilence()
    {
        $this->assertEquals("Fine. Be that way!", $this->bob->respondTo("         "));
    }
    public function testAlternateSilence()
    {
        $this->assertEquals("Fine. Be that way!", $this->bob->respondTo("\t\t\t\t\t\t\t\t\t\t"));
    }
    public function testMultipleLineQuestion()
    {
        $this->assertEquals("Whatever.", $this->bob->respondTo("\nDoes this cryogenic chamber make me look fat?\nno"));
    }
    public function testStartingWithWhitespace()
    {
        $this->assertEquals("Whatever.", $this->bob->respondTo("        hmmmmmmm..."));
    }
    public function testEndingWithWhitespace()
    {
        $this->assertEquals("Sure.", $this->bob->respondTo("Okay if like my  spacebar  quite a bit?   "));
    }
    public function testNonQuestionEndingWithWhitespace()
    {
        $this->assertEquals("Whatever.", $this->bob->respondTo("This is a statement ending with whitespace      "));
    }
}
