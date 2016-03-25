package tajul;

import com.sun.jersey.api.client.Client;
import com.sun.jersey.api.client.ClientResponse;
import com.sun.jersey.api.client.WebResource;
import java.util.*;
 
public class awsclient {
 
	public static void main(String[] args) {
		
		awsclient eucaclient = new awsclient();
		Scanner scan= new Scanner(System.in);
		System.out.println("Select Your Choice");
		System.out.println("Option:"+"\n"+"1: Openstack"+"\n"+"2: Eucalyptus");
		String choose= scan.nextLine();
		if(choose.equals("2")){
			System.out.println("Enter AcccessKey");
	        String accessKey= scan.nextLine();
	        System.out.println("Enter SecretKey");
	        String secretKey= scan.nextLine();
	        System.out.println("Enter Your BucketName that you want to create");
	        String bucketName= scan.nextLine();
	        eucaclient.eucaStorage(accessKey,secretKey,bucketName);
		}
		else{
	        //System.out.println("Enter Identity Name");
	        String i= "facebook850668501726692:facebook850668501726692";
	        //System.out.println("Enter Your Credential");
	        String c= "o4fgzUBFO7j3cLxJ";
	        //System.out.println("Enter Your Bucket Nmae");
	        String b= "abu";
	        String end="http://x86.trystack.org:5000/v2.0/";
	        String o="option";
	      eucaclient.openstackstorage(i,c,b,o,end);
		}

	
	}
 
 
	private void openstackstorage(String i,String c,String b,String o,String end) {
		try {
            
			Client client = Client.create();
			WebResource webResource = client.resource("http://localhost:8080/new/main/"+i+"/"+c+"/"+b+"/"+o+"/"+end);
			ClientResponse response = webResource.accept("application/xml").get(ClientResponse.class);
			if (response.getStatus() != 200) {
				throw new RuntimeException("Failed : HTTP error code : " + response.getStatus());
			}
 
			String output = response.getEntity(String.class);
			System.out.println("============getResponse============");
			System.out.println(output);
 
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	
	
	private void eucaStorage(String accessKey,String secretKey,String bucketName ) {
		try {
 
			Client client = Client.create();
			WebResource webResource = client.resource("http://localhost:8080/new/main/"+accessKey+"/"+secretKey+"/"+bucketName);
			ClientResponse response = webResource.accept("application/xml").get(ClientResponse.class);
			if (response.getStatus() != 200) {
				throw new RuntimeException("Failed : HTTP error code : " + response.getStatus());
			}
 
			String output = response.getEntity(String.class);
			System.out.println("============getResponse============");
			System.out.println(output);
 
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	

}

