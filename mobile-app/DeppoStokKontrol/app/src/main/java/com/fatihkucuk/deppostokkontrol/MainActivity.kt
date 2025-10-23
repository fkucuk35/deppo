package com.fatihkucuk.myqrscanner

import android.app.Activity
import android.content.Intent
import android.os.Bundle
import android.widget.Button
import android.widget.TextView
import androidx.activity.enableEdgeToEdge
import androidx.activity.result.contract.ActivityResultContracts
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat

class MainActivity : AppCompatActivity() {
    private lateinit var qrScanButton: Button
    private lateinit var resultTextView: TextView
    val resultContract = registerForActivityResult(ActivityResultContracts.StartActivityForResult()){
            result: androidx.activity.result.ActivityResult ->
        if(result.resultCode==Activity.RESULT_OK){
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
            if(resultCode== Activity.RESULT_OK){
                resultTextView.setText(data?.getStringExtra("result"))
            }
        }
    }
}