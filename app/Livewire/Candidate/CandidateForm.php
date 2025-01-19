<?php
namespace App\Livewire\Candidate;

use App\Models\Candidate;
use App\Models\District;
use App\Models\School;
use App\Models\State;
use Livewire\Component;

class CandidateForm extends Component
{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $state_id;
    public $district_id;
    public $school_id;
    public $gender;
    public $dob;
    public $status;

    public $districts;
    public $schools;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email,' . ($this->id ?? 'NULL'),
            'phone' => 'nullable|string|max:15',
            'state_id' => 'required|exists:states,id',
            'district_id' => 'required|exists:districts,id',
            'school_id' => 'required|exists:schools,id',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date|before:today',
            'status' => 'required|in:active,inactive',
        ];

        return $rules;
    }


    public function mount($id = null)
    {

        $this->districts = collect();
        $this->schools = collect();

        if ($id) {
            $this->id = $id;
            $candidate = Candidate::find($id);
            if ($candidate) {
                $this->fillFormFields($candidate);
                $this->loadDistricts($candidate->state_id);
                $this->loadSchools($candidate->district_id);
            }
        }
    }

    private function fillFormFields(Candidate $candidate)
    {
        $this->fill($candidate->only([
            'name', 'email', 'phone', 'state_id', 'district_id', 'school_id', 'gender', 'dob', 'status'
        ]));
    }

    public function updatedStateId($stateId)
    {
        $this->district_id = null;
        $this->school_id = null;
        $this->loadDistricts($stateId);
    }

    public function updatedDistrictId($districtId)
    {
        $this->school_id = null;
        $this->loadSchools($districtId);
    }

    public function loadDistricts($stateId)
    {
        $this->districts = District::where('state_id', $stateId)->get()->pluck('name', 'id');
    }

    public function loadSchools($districtId)
    {
        $this->schools = School::where('district_id', $districtId)->get()->pluck('name', 'id');
    }

    public function store()
    {
        $validatedData = $this->validate();

        $candidate = $this->id ? Candidate::find($this->id) : new Candidate();
        $candidate->fill($validatedData);
        $candidate->save();

        return redirect()->route('admin.candidate')->with('successMessage', 'Student ' . ($this->id ? 'updated' : 'created') . ' successfully.');
    }

    public function render()
    {
        $states = State::where('id','!=',99)->orderBy('name')->pluck('name','id');

        $gender_options = collect([
            ['id' => 'male', 'name' => 'Male'],
            ['id' => 'female', 'name' => 'Female'],
        ])->pluck('name', 'id');

        $status_options = collect([
            ['id' => 'active', 'name' => 'Active'],
            ['id' => 'inactive', 'name' => 'Inactive'],
        ])->pluck('name', 'id');

        return view('livewire.candidate.candidate-form', compact('states', 'status_options', 'gender_options'));
    }
}
