package com.fatihkucuk.deppostokkontrol.model

data class ResponseGetStock (
    val success: Boolean,
    val errormsg: String,
    val stock: Int
)
