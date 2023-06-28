<html>
    <table>
        <tr>
            <td colspan="10" style="{{$style['main_info']}}">LAPORAN {{ $type }} - {{ $power_plant['name'] }}</td>
        </tr>
        <tr>
            <td colspan="10" style="{{$style['secondary_info']}}">PERIODE: 01/06/2023 S.D 13/06/2023</td>
        </tr>
        <tr>
            <td colspan="10"></td>
        </tr>
    </table>
    
    <table style="{{$style['table']}}">
        <thead>
            <tr> 
                <th rowspan="2" style="{{$style['header']}}">JAM / TANGGAL</th>
                <th colspan="{{$engine_quantity}}" style="{{$style['header']}}">BEBAN (MESIN)</th>
                <th colspan="{{$engine_quantity}}" style="{{$style['header']}}">JAM OPERASI (MESIN)</th>
                <th rowspan="2" style="{{$style['header']}}">DIBUAT</th>
            </tr>
            <tr>
                @for ($i = 1; $i <= $engine_quantity; $i++)
                    <th style="{{$style['header']}}">{{ $i }}</th>
                @endfor
                @for ($i = 1; $i <= $engine_quantity; $i++)
                    <th style="{{$style['header']}}">{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td style="{{$style['body']}}">{{ $item->date_time }}</td>
                    @for ($i = 1; $i <= $engine_quantity; $i++)
                        <td style="{{$style['body']}}">{{ $item->{"engine_".$i} }}</td>
                    @endfor
                    @for ($i = 1; $i <= $engine_quantity; $i++)
                        <td style="{{$style['body']}}">{{ $item->{"duration_".$i} }}</td>
                    @endfor
                    <td style="{{$style['body']}}">{{ $item->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="{{$style['body']}}">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</html>