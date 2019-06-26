<table>
    <thead>
        <tr>
            <th>编号</th>
            <th>住户</th>
            <th>用户名</th>
            <th>缴费时间</th>
            <th>房租dasd</th>
            <th>水费</th>
            <th>电费12312321</th>
            <th>物业</th>
            <!-- <th>服务费</th> -->
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < count($data); $i++)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$data[$i]->realname}}</td>
            <td>{{$data[$i]->username}}</td>
            <td>{{$data[$i]->created_at}}</td>
            <td>@if ($data[$i]->type == 'rent') {{$data[$i]->real_payment}} @endif</td>
            <td>@if ($data[$i]->type == 'water') {{$data[$i]->real_payment}} @endif</td>
            <td>@if ($data[$i]->type == 'electric'){{$data[$i]->real_payment}} @endif</td>
            <td>@if ($data[$i]->type == 'property') {{$data[$i]->real_payment}} @endif</td>
        </tr>
        @endfor
        <tr>
            <td>合计</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$rent}}</td>
            <td>{{$water}}</td>
            <td>{{$electric}}</td>
            <td>{{$property}}</td>
        </tr>
    </tbody>
</table>