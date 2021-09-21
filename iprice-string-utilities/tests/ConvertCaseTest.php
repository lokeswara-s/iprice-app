<?php

use PHPUnit\Framework\TestCase;
use IPrice\StringUtilities\ConvertCase;

final class ConvertCaseTest extends TestCase{

    public function testWillReturnUppercaseStringToLowercaseString(): void
    {
        $this->assertEquals(
            'this is a lowercase string',
            (new ConvertCase())->toLowerCase('THIS IS A LOWERCASE STRING')
        );
    }

    public function testWillReturnLowercaseStringToUppercaseString(): void
    {
        $this->assertEquals(
            'THIS IS A UPPERCASE STRING',
            (new ConvertCase())->toUpperCase('this is a uppercase string')
        );
    }

    public function testWillReturnRemainUnchangedIfSamecaseOccuredCheckingForLowercase(): void
    {
        $this->assertEquals(
            'this is a lowercase string',
            (new ConvertCase())->toLowerCase('this is a lowercase string')
        );
    }
    public function testWillReturnRemainUnchangedIfSamecaseOccuredCheckingForUppercase(): void
    {
        $this->assertEquals(
            'THIS IS A UPPERCASE STRING',
            (new ConvertCase())->toUpperCase('THIS IS A UPPERCASE STRING')
        );
    }

    public function testWillReturnSpecialCharactersWillBeIgnoredCheckingForUppercase(): void
    {
        $this->assertEquals(
            'THI!S IS A UPPERC@ASE STR^ING',
            (new ConvertCase())->toUpperCase('thi!s is a upperc@ase str^ing')
        );
    }

    public function testWillReturnSpecialCharactersWillBeIgnoredCheckingForLowercase(): void
    {
        $this->assertEquals(
            'thi!s is a upperc@ase str^ing',
            (new ConvertCase())->toLowerCase('THI!S IS A UPPERC@ASE STR^ING')
        );
    }

    public function testWillReturnAlternateString(): void
    {
        $this->assertEquals(
            'hElLo wOrLd',
            (new ConvertCase())->toALternateCase('HELLO WORLD')
        );
        $this->assertEquals(
            'hElLo wOrLd',
            (new ConvertCase())->toALternateCase('hello WORLD')
        );
        $this->assertEquals(
            'hElLo wOrLd',
            (new ConvertCase())->toALternateCase('HELLO world')
        );
    }

    public function testWillReturnFlipcaseString(): void
    {
        $this->assertEquals(
            'hello world',
            (new ConvertCase())->toFlipCase('HELLO WORLD')
        );
        $this->assertEquals(
            'HELLO world',
            (new ConvertCase())->toFlipCase('hello WORLD')
        );
        $this->assertEquals(
            'hello WORLD',
            (new ConvertCase())->toFlipCase('HELLO world')
        );
    }

}