<%@ page contentType="text/json;charset=utf-8"%>
<%@ page import="java.util.*"%>
<%@ page import="net.sf.json.JSON"%>
<%@ page import="org.apache.commons.httpclient.*"%>
<%@ page import="org.apache.commons.httpclient.methods.*"%>
<%!
	public static String jsonProxyPost(HttpServletRequest request)
			throws Exception {
		request.setCharacterEncoding("utf-8");
		String url = request.getParameter("_URL_");
		String service = request.getParameter("_SERVICE_");

		Enumeration en = request.getParameterNames();
		HashMap params = new HashMap();
		while (en.hasMoreElements()) {
			String key = (String) en.nextElement();
			String value = request.getParameter(key);
			params.put(key, value);
		}
		return jsonProxyPost(url, service, params);
	}

	public static String jsonProxyPost(String url, String service,
			HashMap params) {
		System.out.println("jsonProxyPost:" + url  + service + "  params:"
				+ params);
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
		//method.addRequestHeader("Content-Type", "text/html;charset=UTF-8");
		//method.setRequestHeader("Content-Type", "text/html;charset=UTF-8");
		/*PostMethod method = new PostMethod() {
			public String getRequestCharSet() {
				// return super.getRequestCharSet();
				return "UTF-8";
			}
		};*/

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
%>
<%
	//out.println("------------------------");
	out.println(jsonProxyPost(request));
%>