package com.fatihkucuk.deppostokkontrol.view

import android.content.Intent
import android.os.Bundle
import android.widget.Button
import android.widget.TextView
import android.widget.Toast
import androidx.activity.enableEdgeToEdge
import androidx.activity.result.ActivityResult
import androidx.activity.result.contract.ActivityResultContracts
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.fatihkucuk.deppostokkontrol.R
import com.fatihkucuk.deppostokkontrol.model.ResponseGetStock
import com.fatihkucuk.deppostokkontrol.service.DeppoAPI
import kotlinx.coroutines.CoroutineScope
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory

class MainActivity : AppCompatActivity() {
    private lateinit var qrScanButton: Button
    private lateinit var resultTextView: TextView
    val resultContract = registerForActivityResult(ActivityResultContracts.StartActivityForResult()){
            result: ActivityResult ->
        if(result.resultCode== RESULT_OK){
            resultTextView.text = result.data?.getStringExtra("result").toString()
        }
    }
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContentView(R.layout.activity_main)
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.main)) { v, insets ->
            val systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom)
            insets
        }
        qrScanButton = findViewById(R.id.qrScanButton)
        qrScanButton.setOnClickListener{
            val intent = Intent(this, ScanActivity::class.java)
            resultContract.launch(intent)
        }
        resultTextView = findViewById(R.id.resultTextView)
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        if(requestCode==1){
            if(resultCode== RESULT_OK){
                resultTextView.setText(data?.getStringExtra("result"))
                CoroutineScope(Dispatchers.IO).launch {
                    //val stockCode = data?.getStringExtra("result")
                    val stockCode = "150.05.0501.00001"
                    if(stockCode != null){
                        val api = Retrofit.Builder()
                            .baseUrl("http://192.168.12.110/deppo/apis/")
                            .addConverterFactory(GsonConverterFactory.create())
                            .build()
                            .create(DeppoAPI::class.java)
                        val stock = api.getStock().enqueue(object: Callback<ResponseGetStock> {
                            override fun onResponse(
                                call: Call<ResponseGetStock?>,
                                response: Response<ResponseGetStock?>,
                            ) {
                                if(response.isSuccessful){
                                    Toast.makeText(this@MainActivity, "Başarılı İşlem", Toast.LENGTH_SHORT).show();
                                }
                            }

                            override fun onFailure(
                                call: Call<ResponseGetStock?>,
                                t: Throwable,
                            ) {
                                println("onFailure: $t.message");
                            }

                        })
                    }
                }
            }
        }
    }
}