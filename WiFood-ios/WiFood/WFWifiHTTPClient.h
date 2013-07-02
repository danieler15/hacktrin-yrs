//
//  WFWifiHTTPClient.h
//  WiFood
//
//  Created by Daniel Ernst on 6/30/13.
//  Copyright (c) 2013 Daniel Ernst. All rights reserved.
//

#import "AFNetworking.h"
#import <CoreLocation/CoreLocation.h>
#import <Foundation/Foundation.h>
#import "WFWifiHTTPClientDelegate.h"

@interface WFWifiHTTPClient : AFHTTPClient

+ (WFWifiHTTPClient *)sharedWifiHTTPClient;
- (void)performJSONOperation:(NSString *)zip;

@property (nonatomic, retain) NSMutableArray *wifiLocations;
@property bool requestDone;
@property id<WFWifiHTTPClientDelegate> delegate;

@end
