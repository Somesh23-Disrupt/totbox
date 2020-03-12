<table class="tab-content">
    <tbody><tr>
        <td class="text-left">Invoice No :</td>
        <th class="text-left">001</th>

       <!-- <td class="text-right">Date :</td> -->
        <th class="text-right"><td>:</td>{{$date =  \Carbon\Carbon::parse(now())->format('d-m-Y')}}</th>
    </tr></tbody></table>

<table class="tab-content">
    <tr>
        <td class="text-left">Name</td>
        <td> : </td>
        <th>{{ $data['student']->first_name.' '.$data['student']->middle_name.' '.$data['student']->last_name }}</th>

        <td class="text-left">Reg No.</td>
        <td> : </td>
        <th class="text-right">{{ $data['student']->reg_no }}</th>
    </tr>
    <tr>
        <td colspan="6">
            <hr class="hr hr-2">
        </td>
    </tr>
    <tr>
        <td class="text-left">Faculty/Class</td>
        <td> : </td>
        <th>{{ ViewHelper::getFacultyTitle($data['student']->faculty) }}</th>
        <td class="text-left">Sem./Sec.</td>
        <td> : </td>
        <th class="text-right">{{ ViewHelper::getSemesterTitle($data['student']->semester) }}</th>
    </tr>
</table>