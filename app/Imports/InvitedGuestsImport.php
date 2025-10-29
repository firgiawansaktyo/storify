<?php

namespace App\Imports;

use App\Models\InvitedGuest;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth as Auth;


class InvitedGuestsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $userId = Auth::id();
        return new InvitedGuest([
            'user_id'  => $userId,
            'name'     => $row['name'] ?? '',
        ]);
    }
}
