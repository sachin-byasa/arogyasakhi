<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Jenssegers\Optimus\Optimus;
use App\Models\Question;
use App\Models\AnswerType;


class QuestionManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Optimus $opt , Request $request)
    {
        $this->optimus = $opt;
        $this->request =$request;
    }

    public function index()
    {
        $data['all_question']=Question::paginate(10);
        // dd($data);
        return view('question.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['answer_type'] =AnswerType::all();
        // dd($data);
        return view('question.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($_POST);
        // (Condition) ? (Statement1) : (Statement2);
        $answer_defination_array = array(
            'required' => $this->request->input('capturePhotoRequired')
        );
        dd($answer_defination_array);
        $question_array =array(
            'question_key_word'=>$this->request->input('questionKeyWord'),
            'answer_type' => $this->request->input('questionInEnglish'),
            'mandatory_question' => 0,
            'answer_definition' => $this->request->input('capturePhotoRequired'),
        );
        dd($question_array);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
