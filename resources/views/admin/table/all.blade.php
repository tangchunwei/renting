<table>
    @foreach($data as $k => $v)
    <thead>
        <tr>
            <th>{{$k}}</th>
        </tr>
        <tr>
            <th>编号</th>
            <th>住户</th>
            <th>用户名</th>
            <th>缴费时间</th>
            <th>房租</th>
            <th>水费</th>
            <th>电费</th>
            <th>物业</th>
            <!-- <th>服务费</th> -->
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < count($v); $i++)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$v[$i]->realname}}</td>
            <td>{{$v[$i]->username}}</td>
            <td>{{$v[$i]->created_at}}</td>
            <td>@if ($v[$i]->type == 'rent') {{$v[$i]->real_payment}} @endif</td>
            <td>@if ($v[$i]->type == 'water') {{$v[$i]->real_payment}} @endif</td>
            <td>@if ($v[$i]->type == 'electric'){{$v[$i]->real_payment}} @endif</td>
            <td>@if ($v[$i]->type == 'property') {{$v[$i]->real_payment}} @endif</td>
        </tr>
        @endfor
    </tbody>
    @endforeach
</table>