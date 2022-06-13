<div class="portlet">
    <div class="portlet-title">
        <b>Tampilan dari :{{ $data->$id }} - {{ $data->transaction_date }}</b>
    </div>
    <div class="portlet-body">
        <div class="row">
            @foreach($medicines as $m)
            <div class="col-md-4">
                <div class="thumbnail">
                    <img src="" alt="">
                    <div class="caption">
                        <p><b>{{ $m->nama_produk }}</b></p>
                        <hr/>
                        <p>Kategori: {{ $m->nama_kategori }}</p>
                        <p>Harga: Rp. {{ $m->harga_produk }}</p>
                        <p>Jumlah Beli: {{ $m->pivot->quantity }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>