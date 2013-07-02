//
//  WFMapViewController.m
//  WiFood
//
//  Created by Daniel Ernst on 6/30/13.
//  Copyright (c) 2013 Daniel Ernst. All rights reserved.
//

#import "WFMapViewController.h"
#import <GoogleMaps/GoogleMaps.h>
#import "WFWifiHTTPClient.h"
#import "WFWifiLocation.h"

#define START_ZOOM 14

@interface WFMapViewController ()

@end

@implementation WFMapViewController {
    GMSMapView *mapView_;
    UIActivityIndicatorView *_spinner;
}
@synthesize wifiLocations;
- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}


- (void)viewDidLoad
{
    [super viewDidLoad];
    
	// Do any additional setup after loading the view.
    GMSCameraPosition *camera = [GMSCameraPosition cameraWithLatitude:40.754994
                                                            longitude:-73.986697
                                                                 zoom:START_ZOOM];
    mapView_ = [GMSMapView mapWithFrame:CGRectZero camera:camera];
    mapView_.myLocationEnabled = YES;
    mapView_.settings.myLocationButton = YES;
    
    //int heightOffset = 0;
    //mapView_.frame = CGRectMake(0, heightOffset, self.view.frame.size.width, self.view.frame.size.height-heightOffset);
    //[self.view addSubview:mapView_];
    self.view = mapView_;
    
    locManager = [[CLLocationManager alloc] init];
    locManager.delegate = self;
    [locManager startMonitoringSignificantLocationChanges];
    
    [[WFWifiHTTPClient sharedWifiHTTPClient] setDelegate:self];
    [[WFWifiHTTPClient sharedWifiHTTPClient] performJSONOperation:@"10024"];
    
    _spinner = [[UIActivityIndicatorView alloc] initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleGray];
    _spinner.center = CGPointMake(160, 200);
    
    [self.view addSubview:_spinner];
    [self.view bringSubviewToFront:_spinner];

    [_spinner startAnimating];
    
    UIImageView *logo = [[UIImageView alloc] initWithFrame:CGRectMake(0, 0, 60, 55)];
    [logo setImage:[UIImage imageNamed:@"hamfi2.png"]];
    [self.view addSubview:logo];
    
                            
}

- (void)locationManager:(CLLocationManager *)manager didUpdateLocations:(NSArray *)locations {
    
    CLLocation *location = [locations lastObject];
    CLLocationCoordinate2D loc = [location coordinate];
    
    /*
    if (location == nil || [locations count] == 0) {
        loc = CLLocationCoordinate2DMake(40.754994, -73.986697);
    }
    */
    
    [mapView_ setCamera:[GMSCameraPosition cameraWithTarget:loc zoom:START_ZOOM]];
    [locManager stopMonitoringSignificantLocationChanges];
    
    [[WFWifiHTTPClient sharedWifiHTTPClient] performJSONOperation:nil];
    
    
}

- (void)addMarkersFromWifiLocations {
    NSMutableArray *marks = [[NSMutableArray alloc] init];
    
    for (WFWifiLocation *wifi in self.wifiLocations) {
        NSString *latLong = wifi.latLong;
        NSArray *parts = [latLong componentsSeparatedByString:@","];
        float lat = [[parts objectAtIndex:0] floatValue];
        float lng = [[parts objectAtIndex:1] floatValue];
        CLLocationCoordinate2D coord = CLLocationCoordinate2DMake(lat, lng);
        
        GMSMarker *m = [GMSMarker markerWithPosition:coord];
        m.title = wifi.name;
        m.map = mapView_;
        
        int score = [wifi.score intValue];
        
        int multiplier = 25;
        
        float r = 255.0 - (score*multiplier);
        float g = 0.0 + (score*multiplier);
        float b = 0;
        
        
        UIColor *pin = [UIColor colorWithRed:r/255.0 green:g/255.0 blue:b/255.0 alpha:0.8];
                
        
        NSArray *prices = [[NSArray alloc] initWithObjects:@"Free", @"Inexpensive", @"Moderately Expensive", @"Expensive", @"Very Expensive", nil];
        
        NSString *snippet = [NSString stringWithFormat:@"Address: %@\n", wifi.address];
        
        int ratingFloat = [wifi.rating intValue];
        float price = [wifi.priceNum floatValue];
        
        int lines = 1;
        if (wifi.priceNum != nil && price > 0 && price < 11) {
            snippet = [NSString stringWithFormat:@"%@Price: %@\n", snippet, [prices objectAtIndex:price]];
            lines++;
        }
        if (wifi.rating && ratingFloat > 0 && ratingFloat < 6) {
            snippet = [NSString stringWithFormat:@"%@Food: %@/5", snippet, wifi.rating];
            lines++;
        }
        if (lines <= 1) {
            snippet = [NSString stringWithFormat:@"%@No Data Available", snippet];
            pin = [UIColor colorWithRed:100/255.0 green:159/255.0 blue:237/255.0 alpha:1.0];
        }
        m.icon = [GMSMarker markerImageWithColor:pin];
        m.snippet = snippet;
        
        [marks addObject:m];
        
        //UILongPressGestureRecognizer *lp = [[UILongPressGestureRecognizer alloc] initWithTarget:self action:@selector(markerLongPress:)];
        
    
        
        
        
    }
    [_spinner stopAnimating];
}

- (void)markerLongPress:(id)sender {
    
}

- (void)clientDidLoadWifiLocationsList:(NSMutableArray *)wifi {
    self.wifiLocations = wifi;
    [self addMarkersFromWifiLocations];
    //[self.view setNeedsDisplay];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
