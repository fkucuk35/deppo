package com.fatihkucuk.deppostokkontrol.viewmodel

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.fatihkucuk.deppostokkontrol.service.MyStock
import com.fatihkucuk.deppostokkontrol.service.RetrofitInstance
import kotlinx.coroutines.launch

class MainViewModel : ViewModel() {

    private val _stock = MutableLiveData<MyStock>()
    val stock: LiveData<MyStock>
        get() = _stock

    private val _isLoading = MutableLiveData<Boolean>()
    val isLoading : LiveData<Boolean>
        get() = _isLoading

    private val _hasError = MutableLiveData<Boolean>()
    val hasError: LiveData<Boolean>
        get() = _hasError

    init{
        fetchStock()
    }

    fun fetchStock(){
        viewModelScope.launch {
            _isLoading.value = true
            val response = RetrofitInstance.api.getStock()
            if(response.isSuccessful){
                response.body()?.let{stock->
                    _stock.value = stock
                    _hasError.value = false
                }?:run {
                    _hasError.value = true
                }

            }
            else {
                _hasError.value = true
            }
            _isLoading.value = false
        }
    }
}