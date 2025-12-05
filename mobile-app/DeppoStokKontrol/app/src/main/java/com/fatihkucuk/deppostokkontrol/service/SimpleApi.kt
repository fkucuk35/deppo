package com.fatihkucuk.deppostokkontrol.service

import retrofit2.Response
import retrofit2.http.GET

interface SimpleApi {
    @GET("getstock.php")
    suspend fun getStock(): Response<MyStock>
}

data class MyStock(
    val stock: Int,
    val code: String
)