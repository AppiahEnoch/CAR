use PHPUnit\Framework\TestCase;
use Complex\Complex as Complex;

class ComplexTest extends TestCase
{
    public function testCreate()
    {
        $x = new Complex(123);
        $this->assertEquals('123', (string) $x);

        $x = new Complex(123, 456);
        $this->assertEquals('123+456i', (string) $x);

        $x = new Complex(array(123,456,'j'));
        $this->assertEquals('123+456i', (string) $x);

        $x = new Complex('1.23e-4--2.34e-5i');
        $this->assertEquals('0.000123-0.0000234i', (string) $x);
    }

    public function testAdd()
    {
        $x = new Complex(123);
        $x->add(456);
        $this->assertEquals('579', (string) $x);

        $x = new Complex(123.456);
        $x->add(789.012);
        $this->assertEquals('912.468', (string) $x);

        $x = new Complex(123.456, 78.90);
        $x->add(new Complex(-987.654, -32.1));
        $this->assertEquals('-864.198-46.2i', (string) $x);

        $x = new Complex(123.456, 78.90);
        $x->add(-987.654);
        $this->assertEquals('-864.198+78.9i', (string) $x);

        $x = new Complex(-987.654, -32.1);
        $x->add(new Complex(0, 1));
        $this->assertEquals('-987.654-31.1i', (string) $x);

        $x = new Complex(-987.654, -32.1);
        $x->add(new Complex(0, -1));
        $this->assertEquals('-987.654-33.1i', (string) $x);
    }

    public function testSubtract()
    {
        $x = new Complex(123);
        $x->subtract(456);
        $this->assertEquals('-333', (string) $x);

        $x = new Complex(123.456);
        $x->subtract(789.012);
        $this->assertEquals('-665.556', (string) $x);

        $x = new Complex(123.456, 78.90);
        $x->subtract(new Complex(-987.654, -32.1));
        $this->assertEquals('1111.11+110.0i', (string) $x);

        $x = new Complex(123.456, 78.90);
        $x->subtract(-987.654);
        $this->assertEquals('1111.11+78.9i', (string) $x);

        $x = new Complex(-987.654, -32.1);
        $x->subtract(new Complex(0, 1));
        $this->assertEquals('-987.654-33.1i', (string) $x);

        $x = new Complex(-987.654, -32.1);
        $x->subtract(new Complex(0, -1));
        $this->assertEquals('-987.654-31.1i', (string) $x);
    }

    public function testMultiply()
    {
        $x = new Complex(123);
        $x->multiply(456);
        $this->assertEquals('56088', (string) $x);

        $x = new Complex(123.456);
        $x->multiply(789.012);
        $this->assertEquals('97314.825472', (string) $x);

        $x = new Complex(123.456, 78.90);
        $x->multiply(new Complex(-987.654, -32.1));
        $this->assertEquals('-102207.7324-101946.8207i', (string) $x);

        $x = new Complex(123.456, 78.90);
        $x->multiply(-987.654);
        $this->assertEquals('-121905.186024+0.0i', (string) $x);

        $x = new Complex(-987.654, -32.1);
        $x->multiply(new Complex(0, 1));
        $this->assertEquals('32.1-987.654i', (string) $x);

        $x = new Complex(-987.654, -32.1);
        $x->multiply(new Complex(0, -1));
        $this->assertEquals('-32.1+987.654i', (string) $x);
    }

    public function testDivideBy()
    {
        $x = new Complex(123);
        $x->divideBy(456);
        $this->assertEquals('0.26973684210526', (string) $x);

        $x = new Complex(123.456);
        $x->divideBy(789.012);
        $this->assertEquals('0.156168947932', (string) $x);

        $x = new Complex(123.456, 78.90);
        $x->divideBy(new Complex(-987.654, -32.1));
        $this->assertEquals('-0.0002662768-0.0002381096i', (string) $x);

        $x = new Complex(123.456, 78.90);
        $x->divideBy(-987.654);
        $this->assertEquals('-0.124825-0.079787i', (string) $x);

        $x = new Complex(-987.654, -32.1);
        $x->divideBy(new Complex(0, 1));
        $this->assertEquals('32.1+987.654i', (string) $x);

        $x = new Complex(-987.654, -32.1);
        $x->divideBy(new Complex(0, -1));
        $this->assertEquals('-32.1-987.654i', (string) $x);
    }

    public function testDivideInto()
    {
        $x = new Complex(123);
        $x->divideInto(456);
        $this->assertEquals('3.7073170731707', (string) $x);

        $x = new Complex(123.456);
        $x->divideInto(789.012);
        $this->assertEquals('5.0526315789474', (string) $x);

        $x = new Complex(123.456, 78.90);
        $x->divideInto(new Complex(-987.654, -32.1));
        $this->assertEquals('-0.0002662768+0.0002381096i', (string) $x);

        $x = new Complex(123.456, 78.90);
        $x->divideInto(-987.654);
        $this->assertEquals('-7.9268292682927-5.0731707317073i', (string) $x);

        $x = new Complex(-987.654, -32.1);
        $x->divideInto(new Complex(0, 1));
        $this->assertEquals('-32.1+987.654i', (string) $x);

        $x = new Complex(-987.654, -32.1);
        $x->divideInto(new Complex(0, -1));
        $this->assertEquals('32.1-987.654i', (string) $x);
    }
}