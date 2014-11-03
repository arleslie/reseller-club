<?php
use Gufy\ResellerClub\ResellerClub;
class ClassTest extends \Orchestra\Testbench\TestCase
{
  public function testFunctionality()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $this->assertEquals('user-id', $class->config('auth-userid'));
    $this->assertEquals('api-key', $class->config('api-key'));
    $class2 = $class->config('hello', 'hai');
    $this->assertEquals($class, $class2);
    $this->assertEquals('hai', $class->config('hello'));
  }

  public function testQuery()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(true);
    $this->assertTrue($class->config('pretend'));
    $data = $class->from('domains/search')->get();
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals([], $class->config('params'));
  }
  public function testQueryWithParams()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(true);
    $this->assertTrue($class->config('pretend'));
    $data = $class->from('domains/search')
    ->where('no-of-records', 50)
    ->where('page-no', 0)
    ->where(array(
      'order-by'=>'orderid',
      'status'=>'Active'
    ))
    ->get();
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals('GET', $class->config('method'));
    $this->assertEquals([
      'no-of-records'=>50,
      'page-no'=>0,
      'order-by'=>'orderid',
      'status'=>'Active',
    ], $class->config('params'));
  }
  public function testGetQueryWithParams()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(true);
    $this->assertTrue($class->config('pretend'));
    $data = $class
    ->where('no-of-records', 50)
    ->where('page-no', 0)
    ->where(array(
      'order-by'=>'orderid',
      'status'=>'Active'
    ))
    ->get('domains/search');
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals('GET', $class->config('method'));
    $this->assertEquals([
      'no-of-records'=>50,
      'page-no'=>0,
      'order-by'=>'orderid',
      'status'=>'Active',
    ], $class->config('params'));
  }
  public function testPostWithParams()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(true);
    $this->assertTrue($class->config('pretend'));
    $data = $class->from('domains/search')
    ->where('no-of-records', 50)
    ->where('page-no', 0)
    ->where(array(
      'order-by'=>'orderid',
      'status'=>'Active'
    ))
    ->post();
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals('POST', $class->config('method'));
    $this->assertEquals([
      'no-of-records'=>50,
      'page-no'=>0,
      'order-by'=>'orderid',
      'status'=>'Active',
    ], $class->config('params'));
  }
  public function testPostUrlWithParams()
  {
    $class = new ResellerClub('user-id', 'api-key');
    $class->pretend(true);
    $this->assertTrue($class->config('pretend'));
    $data = $class
    ->where('no-of-records', 50)
    ->where('page-no', 0)
    ->where(array(
      'order-by'=>'orderid',
      'status'=>'Active'
    ))
    ->post('domains/search');
    $this->assertEquals('https://httpapi.com/api/domains/search.json', $class->config('url'));
    $this->assertEquals('POST', $class->config('method'));
    $this->assertEquals([
      'no-of-records'=>50,
      'page-no'=>0,
      'order-by'=>'orderid',
      'status'=>'Active',
    ], $class->config('params'));
  }
}