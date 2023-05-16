             PASSOS PARA USAR A API LOCALMENTE

1) Importe o Banco de Dados
2) Inicialize o servidor do PHP: php -S 0.0.0.0:8000

3) Altere na data service para:
   http://10.0.2.2:8000/pessoa
   
4) Repositório do Aplicativo: https://github.com/tiagotas/AppGetSendJson   

5) Confgure seu App Android para requisições inseguras
   (sem https) no arquivo AndroidManifest.xml:

   `<application  android:usesCleartextTraffic="true" ... />`
