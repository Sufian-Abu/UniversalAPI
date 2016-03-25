		package tajul;
		
		
		import java.io.File;
		import java.util.Set;
		
		
		import javax.ws.rs.GET;
		import javax.ws.rs.Path;
		import javax.ws.rs.PathParam;
		import javax.ws.rs.Produces;
		
		
		import org.jclouds.ContextBuilder;
		import org.jclouds.io.Payload;
		import org.jclouds.io.Payloads;
		import org.jclouds.logging.slf4j.config.SLF4JLoggingModule;
		import org.jclouds.openstack.swift.v1.SwiftApi;
		import org.jclouds.openstack.swift.v1.domain.Container;
		import org.jclouds.openstack.swift.v1.domain.ObjectList;
		import org.jclouds.openstack.swift.v1.domain.SwiftObject;
		import org.jclouds.openstack.swift.v1.features.ContainerApi;
		import org.jclouds.openstack.swift.v1.features.ObjectApi;
		import org.jclouds.openstack.swift.v1.options.CreateContainerOptions;
		
		import com.amazonaws.auth.AWSCredentials;
		import com.amazonaws.auth.BasicAWSCredentials;
		import com.amazonaws.regions.Region;
		import com.amazonaws.regions.Regions;
		import com.amazonaws.services.s3.AmazonS3;
		import com.amazonaws.services.s3.AmazonS3Client;
		import com.amazonaws.services.s3.model.Bucket;
		import com.amazonaws.services.s3.model.ListObjectsRequest;
		import com.amazonaws.services.s3.model.ObjectListing;
        import com.amazonaws.services.s3.model.PutObjectRequest;
        import com.amazonaws.services.s3.model.S3ObjectSummary;
		import com.google.common.collect.ImmutableMap;
		import com.google.common.collect.ImmutableSet;
		import com.google.common.io.ByteSource;
		import com.google.common.io.Files;
		import com.google.inject.Module;
		
		
		@Path("/main")
		public class Main {
		    
		    
		    public SwiftApi swiftApi;
		    
		    @Path("{a}/{s}")
		    @GET
		    @Produces("application/xml")
		    public String eucacontainerlist(@PathParam("a") String a,@PathParam("s") String s) {
		        AWSCredentials credentials = null;
		        credentials = new BasicAWSCredentials(a, s);
		
		        AmazonS3 s3 = new AmazonS3Client(credentials);
		        Region usWest2 = Region.getRegion(Regions.US_WEST_2);
		        s3.setRegion(usWest2);
		        
		        String container="";
		        for (Bucket bucket : s3.listBuckets()) {
		        container=container +"\n"+ bucket.getName();
		        }
		 
		        String result = "@Produces(\"application/xml\") Output: \n\nbucketname:" + container+"\n\n";
		        return "<euca>" + "<create>" + container + "</create>" + "<output>" + result + "</output>" + "</euca>";
		        
		    }
		        
		    @Path("{a}/{s}/{b}/{c}")
		    @GET
		    @Produces("application/xml")
		    public String eucacontainercreate(@PathParam("a") String a,@PathParam("s") String s,
		    		                          @PathParam("b") String b,@PathParam("c") String c) {
		         
		   if(c.equals("create"))
		   {
		        AWSCredentials credentials = null;
		        credentials = new BasicAWSCredentials(a, s);
		
		        AmazonS3 s3 = new AmazonS3Client(credentials);
		        Region usWest2 = Region.getRegion(Regions.US_WEST_2);
		        s3.setRegion(usWest2);
		        String bucketName = b;
		
		        s3.createBucket(bucketName);
		 
		        String result = "@Produces(\"application/xml\") Output: \n\nbucketname:" + bucketName+"\n\n";
		        return "<euca>" + "<create>" + bucketName +" Create Successfully"+ "</create>" + "<output>" + result + "</output>" + "</euca>";
		       
		   }else if(c.equals("delete")){
			   
			    AWSCredentials credentials = null;
			    credentials = new BasicAWSCredentials(a, s);
			
			    AmazonS3 s3 = new AmazonS3Client(credentials);
			    Region usWest2 = Region.getRegion(Regions.US_WEST_2);
			    s3.setRegion(usWest2);
			    String bucketName = b;
			
			    ObjectListing objectListing = s3.listObjects(new ListObjectsRequest().withBucketName(bucketName).withPrefix("aws"));
			    for (S3ObjectSummary objectSummary : objectListing.getObjectSummaries()) {
			        s3.deleteObject(bucketName, objectSummary.getKey());
			    }
			    s3.deleteBucket(bucketName);
			            
			   String result = "@Produces(\"application/xml\") Output: \n\nbucketname:" + bucketName+"\n\n";
			return "<euca>" + "<create>" + bucketName +" Delete Successfully"+ "</create>" + "<output>" + result + "</output>" + "</euca>";	
		       
		   }
		    	
		    return null;
		        
  }
		        
	/*@Path("{a}/{s}/{b}/{object}/{f : [a-zA-z]?:/.*}/{csp}/{upload}")
	 @GET
	 @Produces("application/xml")
     public String eucalyptusfileupload(@PathParam("a") String a,@PathParam("s") String s,@PathParam("b") String b,
	 @PathParam("object") String object,@PathParam("f") String f ,@PathParam("csp") String csp,@PathParam("upload") String upload) {
		   
		    AWSCredentials credentials = null;
		    credentials = new BasicAWSCredentials(a, s);
		
		    AmazonS3 s3 = new AmazonS3Client(credentials);
		    Region usWest2 = Region.getRegion(Regions.US_WEST_2);
		    s3.setRegion(usWest2);
		    
		    String bucketName = b;		
            String key="aws";
		    File file = new File(f);
            s3.putObject(new PutObjectRequest(bucketName, key, file));
		          
		          
       String result = "@Produces(\"application/xml\") Output: \n\nbucketname:" + object+"\n\n";
	   return "<euca>" + "<create>" +object+ "upload Suceesfully" + "</create>" + "<output>" + result + "</output>" + "</euca>";
		        
      } */
		    
		    @Path("{i}/{c}/{b}/{o}/{e : http?://.*}")
		    @GET
		    @Produces("application/xml")
		    public String openstackStrorage(@PathParam("i") String i,@PathParam("c") String c,@PathParam("b") String b,
		                                     @PathParam("o") String o,@PathParam("e") String e) {
		        
		        if(o.equals("create"))
		        {
		        
		        String bucketName = b;
		        
		        Iterable<Module> modules = ImmutableSet.<Module>of(
		                new SLF4JLoggingModule());
		
		          String provider = "openstack-swift";
		          String identity = i;
		          String credential = c;
		              
		
		          swiftApi = ContextBuilder.newBuilder(provider)
		                .endpoint(e)
		                .credentials(identity, credential)
		                .modules(modules)
		                .buildApi(SwiftApi.class);
		          
		          ContainerApi containerApi = swiftApi.getContainerApi("RegionOne");
		          CreateContainerOptions options = CreateContainerOptions.Builder
		                .metadata(ImmutableMap.of(
		                      "key1", "value1",
		                      "key2", "value2"));
		
		          containerApi.create(bucketName, options);
		          
		          
		    String result = "@Produces(\"application/xml\") Output: \n\nbucketname:" + bucketName+"\n\n";
		    return "<euca>" + "<create>" + bucketName +" Create Successfully"+ "</create>" + "<output>" + result + "</output>" + "</euca>";
		        
		        
		    
		      }else if(o.equals("delete"))
		        {
		        
		        String bucketName = b;
		        
		        Iterable<Module> modules = ImmutableSet.<Module>of(
		                new SLF4JLoggingModule());
		
		          String provider = "openstack-swift";
		          String identity = i;
		          String credential = c;
		              
		
		          swiftApi = ContextBuilder.newBuilder(provider)
		                .endpoint(e)
		                .credentials(identity, credential)
		                .modules(modules)
		                .buildApi(SwiftApi.class);
		          
		          ContainerApi containerApi = swiftApi.getContainerApi("RegionOne");
		          Set<Container> containers = containerApi.list().toSet();
		          for (Container container : containers) {
		              if((container.getName().equals(bucketName))){
		              ObjectApi objectApi = swiftApi.getObjectApi("RegionOne", container.getName());
		              ObjectList objects = objectApi.list();
		              for (SwiftObject object: objects) {
		                  objectApi.delete(object.getName());
		               }
		              swiftApi.getContainerApi("RegionOne").deleteIfEmpty(container.getName()); 
		              }
		          }
		          
		          
		    String result = "@Produces(\"application/xml\") Output: \n\nbucketname:" + bucketName+"\n\n";
		    return "<euca>" + "<create>" + bucketName +" delete Successfully"+ "</create>" + "<output>" + result + "</output>" + "</euca>";
		            
		            
		        }
		        
		        return null;
		    
		    }
		    
		    
		    @Path("{i}/{c}/{e : http?://.*}")
		    @GET
		    @Produces("application/xml")
		    public String openstackcontainerlist(@PathParam("i") String i,@PathParam("c") String c,@PathParam("e") String e) {
		
		        Iterable<Module> modules = ImmutableSet.<Module>of(
		                new SLF4JLoggingModule());
		
		          String provider = "openstack-swift";
		          String identity = i;
		          String credential = c;
		              
		
		          swiftApi = ContextBuilder.newBuilder(provider)
		                .endpoint(e)
		                .credentials(identity, credential)
		                .modules(modules)
		                .buildApi(SwiftApi.class);
		          
		          ContainerApi containerApi = swiftApi.getContainerApi("RegionOne");
		          Set<Container> containers = containerApi.list().toSet();
		          
		          String list="";
		          for (Container container : containers) {
		             list=list+"  " + container;
		          }
		          
		          
		    String result = "@Produces(\"application/xml\") Output: \n\nbucketname:" + list+"\n\n";
		    return "<euca>" + "<create>" + list + "</create>" + "<output>" + result + "</output>" + "</euca>";
		        
		        
		    
		      }
		    
    @Path("{x}/{y}/{b}/{ob}/{o}/{p : [a-zA-z]?:/.*}/{e : http?://.*}")
    @GET
    @Produces("application/xml")
    public String openstackfileupload(@PathParam("x") String x,@PathParam("y") String y,@PathParam("b") String b,
    @PathParam("ob") String ob,@PathParam("o") String o,@PathParam("p") String p ,@PathParam("e") String e) {
		
    if(o.equals("openstack"))
       {
    	
    	Iterable<Module> modules = ImmutableSet.<Module>of(
		 new SLF4JLoggingModule());
		
		 String provider = "openstack-swift";
		 String identity = x;
		 String credential = y;
		              
		
		          swiftApi = ContextBuilder.newBuilder(provider)
		                .endpoint(e)
		                .credentials(identity, credential)
		                .modules(modules)
		                .buildApi(SwiftApi.class);
		          
		          File file = new File(p);
		          ByteSource byteSource = Files.asByteSource(file);
		          Payload payload = Payloads.newByteSourcePayload(byteSource);
		          swiftApi.getObjectApi("RegionOne", b).put(ob, payload);
		          
		          
		    String result = "@Produces(\"application/xml\") Output: \n\nbucketname:" + ob+"\n\n";
		    return "<euca>" + "<create>" +ob+ " upload Suceesfully" + "</create>" + "<output>" + result + "</output>" + "</euca>";
		        
		 }else if(o.equals("eucalyptus"))
	      {
			    AWSCredentials credentials = null;
			    credentials = new BasicAWSCredentials(x, y);
			
			    AmazonS3 s3 = new AmazonS3Client(credentials);
			    Region usWest2 = Region.getRegion(Regions.US_WEST_2);
			    s3.setRegion(usWest2);
			    
			    String bucketName = b;		
	            String key="aws";
			    File file = new File(p);
	            s3.putObject(new PutObjectRequest(bucketName, key, file));
			          
			          
	       String result = "@Produces(\"application/xml\") Output: \n\nbucketname:" + ob+"\n\n";
		   return "<euca>" + "<create>" +ob+ "upload Suceesfully" + "</create>" + "<output>" + result + "</output>" + "</euca>";		
			 
	
	      }
       return null;

      }
		
		 
 }
		
		
		
