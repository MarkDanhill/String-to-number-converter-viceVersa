<?php

describe('convert', function () {
    test('basic request', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertNumber');
        $response->assertStatus(200);
    });
    test('Onehundred and ten', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertNumber', ['string' => 'Onehundred and ten']);
        $response->assertContent('110');
    });
    test('three hundred and ninety', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertNumber', ['string' => 'three hundred and ninety']);
        $response->assertContent('390');
    });

    test('OneThousand one hundred and one', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertNumber', ['string' => 'OneThousand one hundred and one']);
        $response->assertContent('1101');
    });
    test('ninehundred ninetythousands', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertNumber', ['string' => 'ninehundred ninetythousands']);
        $response->assertContent('990000');
    });
    test('five hundred twenty  thousand', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertNumber', ['string' => 'five hundred twenty thousand']);
        $response->assertContent('520000');
    });

    test('five hundred twenty six thousand', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertNumber', ['string' => 'five hundred twenty six thousand']);
        $response->assertContent('526000');
    });

    test('four hundred ninety eight million', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertNumber', ['string' => 'four hundred ninety eight million']);
        $response->assertContent('498000000');
    });

    test('110', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertString', ['number' => '110']);
        $response->assertContent('one hundred ten');
    });
    test('390', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertString', ['number' => '390']);
        $response->assertContent('three hundred ninety');
    });
    test('1110', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertString', ['number' => '1110']);
        $response->assertContent('one thousand one hundred ten');
    });
    test('990 000', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertString', ['number' => '990000']);
        $response->assertContent('nine hundred ninety   thousand');
    });
    test('526 000', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertString', ['number' => '526000']);
        $response->assertContent('five hundred twenty  six thousand');
    });

    test('498 000 000', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertString', ['number' => '498000000']);
        $response->assertContent('four hundred ninety  eight million');
    });
    test('498 354 210', function () {
        $response = $this->post('http://127.0.0.1:8000/api/convertString', ['number' => '498354210']);
        $response->assertContent('four hundred ninety  eight million three hundred fifty  four thousand two hundred ten');
    });
});
