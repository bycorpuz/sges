<?php

namespace App\Exports;

use App\User;
use App\AccessLevel;
use App\Profile;
use App\Grade;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// use Maatwebsite\Excel\Concerns\FromArray;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// class VoterListExport implements FromArray, ShouldAutoSize
class VoterListExport implements FromView, WithEvents
{
    public function view(): view
    {
        $users = User::where('ref_access_level_id', AccessLevel::VOTER)->get();

        $user_list = array();

        $widths = array(
            'full_name' => 15,
            'lrn' => 10,
            'grade' => 15,
            'section' => 15,
            'signature' => 40,
            'thumb_mark' => 20,
            'username' => 23,
            'password' => 15,
        );

        foreach($users as $user) {
            $full_name = $user->profile->first_name.' '.$user->profile->middle_name.' '.$user->profile->last_name;
            $widths['full_name'] = (strlen($full_name) + 8) > $widths['full_name'] ? (strlen($full_name) + 8) : $widths['full_name'];

            array_push($user_list, [
                'full_name' => $full_name,
                'lrn' => $user->profile->lrn,
                'grade' => $user->profile->grade->grade,
                'section' => $user->profile->section,
                'signature' => '',
                'thumb_mark' => '',
                'username' => $user->username,
                'password' => $user->generateVoterPassword(),
            ]);
        }

        return view('reports.voter_list', [
            'user_list' => $user_list,
            'widths' => $widths,
        ]);
    }

    public function registerEvents(): array
    {
        $user_count = User::where('ref_access_level_id', AccessLevel::VOTER)->get()->count();
        
        return [
            AfterSheet::class    => function(AfterSheet $event) use ($user_count){
                $cellRange_header = 'A3:G3'; // All headers
                $cellRange_content = 'A3:G'.(4 + $user_count);

                $event->sheet->getDelegate()->getStyle($cellRange_header)->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle($cellRange_header)->getFont()->setSize(12);
                $event->sheet->getDelegate()->getStyle($cellRange_content)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($cellRange_content)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            },
        ];
    }

    // public function array(): array
    // {
    //     $users = User::where('ref_access_level_id', AccessLevel::VOTER)->get();

    //     $user_list = array();

    //     array_push($user_list,[
    //         'Full Name',
    //         'Grade',
    //         'Section',
    //         'Signature',
    //         'Thumb Mark',
    //         'Username (LRN)',
    //         'Password',
    //     ]);

    //     foreach($users as $user) {
    //         array_push($user_list, [
    //             'full_name' => $user->profile->first_name.' '.$user->profile->middle_name.' '.$user->profile->last_name,
    //             'lrn' => $user->profile->lrn,
    //             'grade' => $user->profile->grade->grade,
    //             'section' => $user->profile->section,
    //             'signature' => '',
    //             'thumb_mark' => '',
    //             'username' => $user->username,
    //             'password' => $user->generateVoterPassword(),
    //         ]);
    //     }

    //     dd($user_list);

    //     return $user_list;
    // }
}
