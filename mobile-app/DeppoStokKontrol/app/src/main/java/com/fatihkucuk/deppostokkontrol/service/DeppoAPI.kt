package com.fatihkucuk.deppostokkontrol.service

import com.fatihkucuk.deppostokkontrol.model.ResponseGetStock
import retrofit2.Call
import retrofit2.http.GET

interface DeppoAPI {

    //BASE URL ->   http://DEPO-NB/deppo/apis/
    //ENDPOINT ->   getStock.php?stockId= :stockId

    @GET("getStock.php")
    public suspend fun getStock() : Call<ResponseGetStock>
}