<%@ page contentType="text/json;charset=utf-8"%>
<%@ page import="java.util.*"%>
<%@ page import="net.sf.json.*"%>
<%@ page import="org.apache.commons.httpclient.*"%>
<%@ page import="org.apache.commons.httpclient.methods.*"%>
<%@ page import="javax.crypto.*"%>
<%@ page import="java.security.*"%>
<%@ page import="java.io.*"%>
<%@ page import="javax.crypto.spec.*"%>
 
<%!
// ucore1 ADE1C062E16EAB4AACA11F7F89053FFD==>chenshiming
//login test: http://testenv.bsp.bsteel.net/baosteel_cas2/service_proxy2.jsp?_SERVICE_=dologin2.php&userName=chenshiming&userPassword=password
//query test:http://testenv.bsp.bsteel.net/baosteel_cas2/service_proxy2.jsp?_SERVICE_=buginfos2.php&pageIndex=1&pageSize=3&isAssignMe=1  
	public static String jsonProxyPost(HttpServletRequest request)
			throws Exception {
		String aesPassword = "73C58BAFE578C59366D8C995CD0B9D6D";	
		request.setCharacterEncoding("utf-8");
		String url = "http://service.bsteel.com/BugFree1.0/rest/";
		String service = request.getParameter("_SERVICE_");

		Enumeration en = request.getParameterNames();
		HashMap params = new HashMap();
		while (en.hasMoreElements()) {
			String key = (String) en.nextElement();
			String value = request.getParameter(key);
			params.put(key, value);
		}
		

		boolean isLogin = false;
		System.out.println("service="+service);
		if(service.equals("dologin2.php")){isLogin = true;}
		if(!isLogin){
			String ucore1 = request.getHeader("ucore1");
			System.out.println("ucore1="+ucore1);
			if(ucore1!=null){
				byte[] decryptFrom = parseHexStr2Byte(ucore1);
				byte[] decryptResult = decrypt(decryptFrom, aesPassword);
				String sessionUserName = new String(decryptResult);
				params.put("userName",sessionUserName);
			}
		}
		System.out.println("url="+url);
		System.out.println("service="+service);
		System.out.println("params="+params);
		String json = jsonProxyPost(url, service, params);
		System.out.println("json result="+json);
		if(isLogin){
			if(json==null){
				return "";
			}
			JSONObject jsonObject = JSONObject.fromObject(json);	   	
		   	String resultFlag = jsonObject.getString("resultFlag");
		   	if(resultFlag!=null && resultFlag.equals("0")){
		   		String sessionUserName = jsonObject.getString("userName");
			   	byte[] encryptResult = encrypt(sessionUserName, aesPassword);
				String encryptResultStr = parseByte2HexStr(encryptResult);	
			   	jsonObject.put("ucore1", encryptResultStr);   
				json = jsonObject.toString();		   	
			}
		}
		return json;
	}




	
	public static String jsonProxyPost(String url, String service,
			HashMap params) {
		System.out.println("jsonProxyPost:" + url  + service + "  params:" + params);
		String returnMessage = null;
		try {
			returnMessage = proxyPost(url, service, params);
		} catch (Exception e) {
			// e.printStackTrace();
			returnMessage = "{\"resultFlag\":\"1\",\"resultMessage\":\"Proxy connect reject!\"}";
		}
		System.out.println("jsonProxy return:"+returnMessage);
		return returnMessage;

	}

	public static String proxyPost(String url, String service, HashMap params)
			throws Exception {
		if (params == null) {
			params = new HashMap();
		}

		String response = null;
		HttpClient client = new HttpClient();
		PostMethod method = new UTF8PostMethod(url + service);

		Iterator it = params.keySet().iterator();
		NameValuePair[] pairs = new NameValuePair[params.size()];
		int i = 0;
		while (it.hasNext()) {
			String key = (String) it.next();
			String value = (String) params.get(key);
			pairs[i] = new NameValuePair(key, value);
			i++;
		}
		method.setRequestBody(pairs);
		try {
			client.executeMethod(method);
			if (method.getStatusCode() == HttpStatus.SC_OK) {
				response = method.getResponseBodyAsString();
			}
		} finally {
			method.releaseConnection();
		}
		return response;
	}

 static class UTF8PostMethod extends PostMethod{
    public UTF8PostMethod(String url){ 
        super(url);
    }
    public String getRequestCharSet() {
     return "UTF-8";
    }
}	


/*
		String content = "chenshiming0802@163.com";
		String password = "73C58BAFE578C59366D8C995CD0B9D6D";
		// 
		System.out.println("¼ÓÃÜÇ°£º" + content);
		byte[] encryptResult = encrypt(content, password);
		String encryptResultStr = parseByte2HexStr(encryptResult);
		// 
		byte[] decryptFrom = parseHexStr2Byte(encryptResultStr);
		byte[] decryptResult = decrypt(decryptFrom, password);
		System.out.println("½âÃÜºó£º" + new String(decryptResult));
*/
public static byte[] encrypt(String content, String password) {
	try {
		KeyGenerator kgen = KeyGenerator.getInstance("AES");
		kgen.init(128, new SecureRandom(password.getBytes()));
		SecretKey secretKey = kgen.generateKey();
		byte[] enCodeFormat = secretKey.getEncoded();
		SecretKeySpec key = new SecretKeySpec(enCodeFormat, "AES");
		Cipher cipher = Cipher.getInstance("AES");// ´´½¨ÃÜÂëÆ÷
		byte[] byteContent = content.getBytes("utf-8");
		cipher.init(Cipher.ENCRYPT_MODE, key);// ³õÊ¼»¯
		byte[] result = cipher.doFinal(byteContent);
		return result; // ¼ÓÃÜ
	} catch (NoSuchAlgorithmException e) {
		e.printStackTrace();
	} catch (NoSuchPaddingException e) {
		e.printStackTrace();
	} catch (InvalidKeyException e) {
		e.printStackTrace();
	} catch (UnsupportedEncodingException e) {
		e.printStackTrace();
	} catch (IllegalBlockSizeException e) {
		e.printStackTrace();
	} catch (BadPaddingException e) {
		e.printStackTrace();
	}
	return null;
}
public static byte[] decrypt(byte[] content, String password) {
	try {
		KeyGenerator kgen = KeyGenerator.getInstance("AES");
		kgen.init(128, new SecureRandom(password.getBytes()));
		SecretKey secretKey = kgen.generateKey();
		byte[] enCodeFormat = secretKey.getEncoded();
		SecretKeySpec key = new SecretKeySpec(enCodeFormat, "AES");
		Cipher cipher = Cipher.getInstance("AES");// ´´½¨ÃÜÂëÆ÷
		cipher.init(Cipher.DECRYPT_MODE, key);// ³õÊ¼»¯
		byte[] result = cipher.doFinal(content);
		return result; // ¼ÓÃÜ
	} catch (NoSuchAlgorithmException e) {
		e.printStackTrace();
	} catch (NoSuchPaddingException e) {
		e.printStackTrace();
	} catch (InvalidKeyException e) {
		e.printStackTrace();
	} catch (IllegalBlockSizeException e) {
		e.printStackTrace();
	} catch (BadPaddingException e) {
		e.printStackTrace();
	}
	return null;
}
public static byte[] parseHexStr2Byte(String hexStr) {
	if (hexStr.length() < 1)
		return null;
	byte[] result = new byte[hexStr.length() / 2];
	for (int i = 0; i < hexStr.length() / 2; i++) {
		int high = Integer.parseInt(hexStr.substring(i * 2, i * 2 + 1), 16);
		int low = Integer.parseInt(hexStr.substring(i * 2 + 1, i * 2 + 2),
				16);
		result[i] = (byte) (high * 16 + low);
	}
	return result;
}
public static String parseByte2HexStr(byte buf[]) {
	StringBuffer sb = new StringBuffer();
	for (int i = 0; i < buf.length; i++) {
		String hex = Integer.toHexString(buf[i] & 0xFF);
		if (hex.length() == 1) {
			hex = '0' + hex;
		}
		sb.append(hex.toUpperCase());
	}
	return sb.toString();
}
%>
<%
response.setHeader("Access-Control-Allow-Origin","*"); 
response.setHeader("Access-Control-Allow-Methods","POST, GET"); 
response.setHeader("Access-Control-Allow-Headers","ucore1"); 
response.setHeader("Access-Control-Max-Age","1728000"); 
out.println(jsonProxyPost(request));
%>