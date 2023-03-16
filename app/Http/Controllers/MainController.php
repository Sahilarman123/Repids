<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SymfonyApi;
use Validator;

class MainController extends Controller
{
    public function LoadLogin(){
        return view('login');
    }

    public function LoginUser(Request $request)
    {
        $rules = array(                      
            'email'            => 'required|email',
            'password'         => 'required' 
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            $messages = $validator->messages();

            return redirect()->back()->withErrors($validator);
    
        }
        $api = new SymfonyApi();
        $accessToken = $api->login($request->email, $request->password);
       
        return redirect()->route('dashboard');
    }

    public function Auth(){
        $api = new SymfonyApi();
        $accessToken = $api->login('ahsoka.tano@q.agency', 'Kryze4President');
        $data = $api->getLoggedInUser($accessToken);
        return view('layout2',compact('data'));
    }

    public function dashboard(){
        $api = new SymfonyApi();
        $accessToken = $api->login('ahsoka.tano@q.agency', 'Kryze4President');
        $data = $api->getAllAuthors($accessToken);
        $user = $api->getLoggedInUser($accessToken);
        $result = $data->items;
        return view('dashboard',compact('result','user'));
    }
 
    public function delete_author($id){
        $api = new SymfonyApi();
        $accessToken = $api->login('ahsoka.tano@q.agency', 'Kryze4President');
        $data = $api->deleteAuthor($id,$accessToken);
        return redirect()->back();
    }

    public function delete_book($id){
        $api = new SymfonyApi();
        $accessToken = $api->login('ahsoka.tano@q.agency', 'Kryze4President');
        $data = $api->deleteBook($id,$accessToken);
        return redirect()->back();
    }

    public function view_author($id){
        $api = new SymfonyApi();
        $accessToken = $api->login('ahsoka.tano@q.agency', 'Kryze4President');
        $data = $api->getAuthor($id,$accessToken);
        $user = $api->getLoggedInUser($accessToken);
        $book = $data->books;
        return view('view-author',compact('book','user','data'));
    }
   
    public function AddBook(){
        $api = new SymfonyApi();
        $accessToken = $api->login('ahsoka.tano@q.agency', 'Kryze4President');
        $data = $api->getAllAuthors($accessToken);
       
        $result = $data->items;
        $user = $api->getLoggedInUser($accessToken);
        return view('add-book',compact('user','result'));
    }

    public function CreateBooks(Request $request)
    {
        
        $api = new SymfonyApi();
        $accessToken = $api->login('ahsoka.tano@q.agency', 'Kryze4President');
        $accessToken = $api->CreateBook($accessToken,$request->author_id,$request->title,$request->release_date,$request->description,$request->isbn,$request->format,$request->number_of_pages,);
       
        return redirect()->route('dashboard');
    }

    public function profile(){
        $api = new SymfonyApi();
        $accessToken = $api->login('ahsoka.tano@q.agency', 'Kryze4President');
        $user = $api->getLoggedInUser($accessToken);
        return view('profile',compact('user'));
    }

    public function logout(){
        $api = new SymfonyApi();
        return view('login',compact('user'));
    }

}
