  {{-- LỊCH TRỰC

  <div>
    <h1 style="font-size:24px; text-align:center; font-weight:400; padding-top: 35px; padding-bottom:40px"> LỊCH
        TRỰC </h1>


</div>

<table class="table table-striped" style="width: 100%;margin: 0 auto">
    <thead>
        @foreach ($lichtruc as $lt)
            <tr>
                <th scope="col">Ngày Trực</th>
                <th scope="col">Tên Bác Sĩ</th>
                <th scope="col">Hành Động</th>

            </tr>
    </thead>
    <tbody>

        <tr>
            <td> {{ $lt->lt_Ngaytruc }}</td>
            <td>{{ $lt->lt_tenbacsi }} </td>

            <td>
                <a href="{{ route('Admin.sualichtruc', ['id' => $lt->lt_Id]) }}" class="btn btn-primary"><i
                        class="fa-regular fa-pen-to-square"></i></a>
                <a href="{{ route('Admin.xoalichtruc', ['id' => $lt->lt_Id]) }}" class="btn btn-danger"><i
                        class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>


</main>
</div>



</div> --}}
