<?php
 
namespace App\Http\Controllers;
use Validator;
use App\Models\Customer;
 
class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
		
    }
               
   /**
    * Method to get all customers
    *
    * @author Rachel
    */
                public function getAllCustomers() {die('ddd');
                $response = Customer::all();
               
                 return $response;
                }
 
    /**
    * Method to create new record into customer table
    *
    * @author Rachel
    */
                public function createCustomer(Request $request) {
        $response = array();
        $parameters = $request->json()->all();
 
        $rules =  array(
            'name'    => 'required'
        );
        $customer_name = $parameters['name'];
 
        $messages = array(
            'name.required' => 'name is required.'
        );
 
        $validator = \Validator::make(array('name' => $customer_name), $rules, $messages);
        if(!$validator->fails()) {
            $response = Customer::create($parameters);
 
            return Helper::jsonpSuccess($response);
        } else {
         $errors = $validator->errors();
            return Helper::jsonpError('Validation error(s) occurred', 400, 400, $errors->all());
      }
                }
 
    /**
    * Method to update record into customer table
    *
    * @author Rachel
    */
    public function updateCustomer(Request $request, $id) {
        $response = array();
        $parameters = $request->json()->all();
        $customer = Customer::find($id);
       
        if(!empty($customer)) {
            $customer->Name = $parameters['name'];
            $customer->Id = $id;
            $customer->Address = $parameters['address'];
            $customer->Country = $parameters['country'];
            $customer->Phone = $parameters['phone'];
 
            $customer->save();
            return Helper::jsonpSuccess($customer);
           
        } else {
            return Helper::jsonpError('Record Does not found', 400, 400, '');
        }
    }
 
    /**
    * Method to delete record from customer table
    *
    * @author Rachel
    */
    public function deleteCustomer($id) {
        $customer = Customer::find($id);
       
        if(!empty($customer)) {
            $res = $customer->delete();
 
            return Helper::jsonpSuccess($res);
           
        } else {
            return Helper::jsonpError('Record Does not found', 400, 400, '');
        }
    }
}