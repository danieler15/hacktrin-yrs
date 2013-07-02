//
//  WFWifiHTTPClient.m
//  WiFood
//
//  Created by Daniel Ernst on 6/30/13.
//  Copyright (c) 2013 Daniel Ernst. All rights reserved.
//

#import "WFWifiHTTPClient.h"
#import "WFWifiLocation.h"

@implementation WFWifiHTTPClient {
    bool _hasSentRequest;
}
@synthesize wifiLocations, requestDone;
+ (WFWifiHTTPClient *)sharedWifiHTTPClient
{
    NSString *urlStr = @"http://localhost/yrs/";
    
    static dispatch_once_t pred;
    static WFWifiHTTPClient *_sharedWifiHTTPClient = nil;
    
    dispatch_once(&pred, ^{ _sharedWifiHTTPClient = [[self alloc] initWithBaseURL:[NSURL URLWithString:urlStr]]; });
    return _sharedWifiHTTPClient;
}

- (id)initWithBaseURL:(NSURL *)url
{
    self = [super initWithBaseURL:url];
    if (!self) {
        return nil;
    }
    
    [self registerHTTPOperationClass:[AFJSONRequestOperation class]];
    [self setDefaultHeader:@"Accept" value:@"application/json"];
    self.requestDone = false;
    
    return self;
}


- (void)performJSONOperation:(NSString *)zip {
    _hasSentRequest = true;
    
    NSMutableDictionary *params;
    if (zip) {
        params = [[NSMutableDictionary alloc] init];
        [params setObject:zip forKey:@"q"];
    }
    
    
    [self getPath:@"jsonReformat.php" parameters:params
          success:^(AFHTTPRequestOperation *operation, id responseObject)   {
              
              
              NSDictionary *json = (NSDictionary *)responseObject;
              NSArray *items = [json objectForKey:@"data"];
              NSMutableArray *w = [self locationObjectsFromJsonArray:items];
              
              [self.delegate clientDidLoadWifiLocationsList:w];
              
              
          }
     
          failure:^(AFHTTPRequestOperation *operation, NSError *error) {
              NSLog(@"%@", [error userInfo]);
              
              [self.delegate clientDidLoadWifiLocationsList:nil];
          }];
}

- (NSMutableArray *)locationObjectsFromJsonArray:(NSArray *)items {
    NSMutableArray *wifiLocations = [[NSMutableArray alloc] init];
    NSArray *vars = [[NSArray alloc] initWithObjects:@"name", @"address", @"latLong", @"score", @"zip", @"priceNum", @"rating", @"website", @"phone", @"id", nil];
    
    for (NSDictionary *dict in items) {
        WFWifiLocation *wifi = [[WFWifiLocation alloc] init];
        for (NSString *var in vars) {
            [wifi setValue:[dict valueForKey:var] forKey:var];
        }
        [wifiLocations addObject:wifi];
        
    }
    return wifiLocations;
    
}

@end
