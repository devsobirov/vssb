<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Person;

class AppointmentController extends Controller
{
    public function list(Person $person)
    {
        $appointments = $person->appointments;
        return view('admin.person.appointments', compact('person', 'appointments'));
    }

    public function save(Request $request, $id = null)
    {
        $appointment = Appointment::getOrCreate($id);
        if ($p_id = $request->person_id) $appointment->person_id = $p_id;
        $appointment->weekday = $request->weekday;
        $appointment->time = $request->time;
        $result = $appointment->save();

        if ($result) {
            return redirect()->route('appointments.list', ['person' => $appointment->person_id])
                ->with(['success' => 'Muvaffaqiyatli saqlandi!']);
        }
        return redirect()->back()->withErrors(['msg' => 'No\'malum xatolik, qayta urinib ko\'ring']);
    }

    public function delete(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->back()->with(['success' => 'Muvaffaqiyatli o\'chirildi!']);
    }
}
