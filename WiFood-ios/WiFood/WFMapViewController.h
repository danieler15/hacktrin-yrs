//
//  WFMapViewController.h
//  WiFood
//
//  Created by Daniel Ernst on 6/30/13.
//  Copyright (c) 2013 Daniel Ernst. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <CoreLocation/CoreLocation.h>
#import "WFWifiHTTPClientDelegate.h"

@interface WFMapViewController : UIViewController <CLLocationManagerDelegate, WFWifiHTTPClientDelegate> {
    CLLocationManager *locManager;
}
@property (nonatomic, retain) NSMutableArray *wifiLocations;
@property (nonatomic, retain) NSMutableArray *markers;

@end
