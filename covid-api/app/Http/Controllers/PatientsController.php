<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patients;


class PatientsController extends Controller
{

    // Create function format for patient
    private function formatPatient($patient){
        return [
            'id' => $patient->id,
            'name' => $patient->name,
            'phone' => $patient->phone,
            'address' => $patient->address,
            'status' => $patient->status,
            'in_date_at' => $patient->in_date_at,
            'out_date_at' => $patient->out_date_at,
            'created_at' => $patient->created_at,
            'updated_at' => $patient->updated_at,
        ];
    }

    // Create function mappingData with response
    private function mappingData($data, $messageSuccess, $messageError){

        if ($data->isNotEmpty()) {

            $data = $data -> map(function ($data) {
                return $this->formatPatient($data);
            });

            $response = [
                'message' => "$messageSuccess",
                'data' => $data
            ];

            return response() -> json($response, 200);
        };

        $response = [
            'message' => "$messageError",
        ];

        return response() -> json($response, 404);
    }

    // Get all resource
    public function index() {

        $patients = Patients::all();

        return $this->mappingData($patients,'Get All Patients','Patients Is Empty');

    }

    // Create add resource
    public function store(Request $request) {

        $validateRequest = $request->validate([
            'name' => 'required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'status' => 'required',
            'in_date_at' => 'date|required',
            'out_date_at' => 'date|required'
        ]);

        $patient = Patients::create($validateRequest);

        $response = [
            'message' => 'Patient Is Created Successfully',
            'data' => $patient
        ];

        return response() -> json($response, 201);
    
        $err = [
            'message' => 'Add Patient Failed'
        ];

        return response() -> json($err, 204);

    }

    // Get patient by id
    public function show($id){

        $patient = Patients::find($id);

        if ($patient == null) {

            $error = [
                'message' => 'Patient Not Found'
            ];
            return response() -> json($error, 404);

        } else {

            $response = [
                'message' => 'Show Patient By Id is Successfully',
                'data' => $patient
            ];
            return response() -> json($response, 200);

        }
    }

    // Create update patient
    public function update(Request $request,$id) {

        $patient = Patients::find($id);

        if ($patient) {
            $patient -> update([
                'name' => ($request -> name != null) ? $request -> name : $patient -> name,
                'phone' => ($request -> phone != null) ? $request -> phone : $patient -> phone,
                'address' => ($request -> address != null) ? $request -> address : $patient -> address,
                'status' => ($request -> status != null) ? $request -> status : $patient -> status,
                'in_date_at' => ($request -> in_date_at != null) ? $request -> in_date_at : $patient -> in_date_at,
                'out_date_at' => ($request -> out_date_at != null) ? $request -> out_date_at : $patient -> out_date_at,
            ]);

            $response = [
                'message' => 'Patient Is Update Successfully',
                'data' => $patient
            ];
            return response() -> json($response, 200);

        } else {
            $error = [
                'message' => 'Update Failed'
            ];
            return response() -> json($error, 204);
        }

    }

    // Delete patient by id
    public function destroy($id) {

        $patient = Patients::find($id);

        if ($patient) {
            $patient->delete();

            $message = [
                'message' => 'Deleted Succesfully'
            ];

            return response()->json($message, 200);
        } else {

            $err = [
                'message' => 'Patient Not Found'
            ];
            return response()->json($err, 404);
        }

    }

    // Search patient by name
    public function search($name) {

        $patient = Patients::where('name', 'like', "%$name%")->get();

        return $this->mappingData($patient, 'Get Searched Patient', 'Patient Not Found');

    }

    // Get patient positive
    public function positive() {

        $patientPositive = Patients::where('status', 'like', '%positive%')->get();

        return $this->mappingData($patientPositive, 'Get Searched Patient Positive', 'Patient Positive Not Found');

    }

    // Get patient recovered
    public function recovered() {

        $patientRecovered = Patients::where('status', 'like', '%recovered%')->get();

        return $this->mappingData($patientRecovered, 'Get Searched Patient Recovered', 'Patient Recovered Not Found');

    }

    // Get patient dead
    public function dead() {

        $patientDead = Patients::where('status', 'like', '%dead%')->get();

        return $this->mappingData($patientDead, 'Get Searched Patient Dead', 'Patient Dead Not Found');

    }

}
