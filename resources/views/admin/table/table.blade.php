<table>
    <thead>
        <!-- <tr>
            <th colspan="4" align="center">收入</th>
        </tr> -->
        <tr>
            <th>会计科目</th>
            <th>二级科目</th>
            <th>本月数</th>
            <th>本年累计数</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>财政补助收入</td>
            <td>各类房屋</td>
            <td>{{$month}}</td>
            <td>{{$year}}</td>
        </tr>
        <tr>
            <td>其他应付款</td>
            <td>押金</td>
            <td>{{$contractMonth}}</td>
            <td>{{$contractYear}}</td>
        </tr>
        <tr>
            <td>合计</td>
            <td></td>
            <td>{{$monthTotal}}</td>
            <td>{{$yearTotal}}</td>
        </tr>
        <tr>
            <td>单位负责人</td>
            <td></td>
            <td>会计主管</td>
            <td></td>
        </tr>
    </tbody>
</table>