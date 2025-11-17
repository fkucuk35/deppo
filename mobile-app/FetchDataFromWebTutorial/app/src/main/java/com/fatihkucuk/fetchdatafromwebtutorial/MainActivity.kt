package com.fatihkucuk.fetchdatafromwebtutorial

import android.os.Bundle
import androidx.activity.ComponentActivity
import androidx.activity.enableEdgeToEdge
import com.fatihkucuk.fetchdatafromwebtutorial.databinding.ActivityMainBinding
import com.google.gson.Gson
import java.io.InputStreamReader
import java.net.URL
import javax.net.ssl.HttpsURLConnection

class MainActivity : ComponentActivity() {
    private lateinit var binding: ActivityMainBinding
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)
        enableEdgeToEdge()
        fetchCurrencyData().start()
    }

    private fun fetchCurrencyData(): Thread {
        return Thread {
            val url = URL("https://open.er-api.com/v6/latest/aud")
            val connection = url.openConnection() as HttpsURLConnection
            if(connection.responseCode == 200){
                val inputSystem = connection.inputStream
                val inputStreamReader = InputStreamReader(inputSystem, "UTF-8")
                val request = Gson().fromJson(inputStreamReader, Request::class.java)
                updateUI(request)
                inputStreamReader.close()
                inputSystem.close()
            }
            else {
                binding.lastUpdated.text = "Failed Connection!"
            }
        }
    }

    private fun updateUI(request: Request) {
        runOnUiThread {
            kotlin.run {
                binding.lastUpdated.text = request.time_last_update_utc
                binding.gbpTextView.text = "GBP: " + request.rates.GBP
            }
        }
    }
}