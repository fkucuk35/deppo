package com.fatihkucuk.deppostokkontrol.view

import android.content.Intent
import android.os.Bundle
import android.widget.Button
import android.widget.ProgressBar
import android.widget.TextView
import androidx.activity.enableEdgeToEdge
import androidx.activity.result.ActivityResult
import androidx.activity.result.contract.ActivityResultContracts
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import androidx.core.view.isVisible
import com.fatihkucuk.deppostokkontrol.R
import com.fatihkucuk.deppostokkontrol.viewmodel.MainViewModel

class MainActivity : AppCompatActivity() {
    private val mainViewModel: MainViewModel by viewModels()
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
        mainViewModel.stock.observe(this){
            myStock->
            findViewById<TextView>(R.id.resultTextView).text = myStock.code
        }
        mainViewModel.isLoading.observe(this){
            isLoading->
            findViewById<ProgressBar>(R.id.Yukleniyor).isVisible = isLoading
        }
        mainViewModel.hasError.observe(this){
            hasError->
            findViewById<TextView>(R.id.HataMesaji).isVisible = hasError
        }
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        if(requestCode==1){
            if(resultCode== RESULT_OK){
                resultTextView.setText(data?.getStringExtra("result"))
            }
        }
    }
}