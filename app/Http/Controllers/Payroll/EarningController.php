<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = \App\Models\EarningType::all();
        return view('earnings.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'payslip' => 'required',
            'type' => 'required',
            'amount' => 'required',
        ]);

        $payslip = \App\Models\Payslip::with('payroll', 'user')->whereHashslug($request->payslip)->firstOrFail();
        $type = \App\Models\EarningType::find($request->type);

        $payslip->earnings()->create([
            'user_id' => $payslip->user_id,
            'payroll_id' => $payslip->payroll_id,
            'earning_type_id' => $request->type,
            'name' => $type->name,
            'description' => $type->name,
            'amount' => money()->toMachine($request->amount),
        ]);

        swal()->success('Earning', 'You have successfully added new earning.');

        return redirect()->route('payslip.show', $request->payslip);
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
        \App\Models\Earning::whereHashslug($id)->delete();

        swal()->success('Earning', 'You have successfully delete an earning.');

        return back();
    }
}
