//
//  WifiLocationFavorite.h
//  WiFood
//
//  Created by Daniel Ernst on 6/30/13.
//  Copyright (c) 2013 Daniel Ernst. All rights reserved.
//

#import <Foundation/Foundation.h>
#import <CoreData/CoreData.h>


@interface WifiLocationFavorite : NSManagedObject

@property (nonatomic, retain) NSString * name;
@property (nonatomic, retain) NSString * address;
@property (nonatomic, retain) NSString * latLong;
@property (nonatomic, retain) NSString * zip;
@property (nonatomic, retain) NSString * priceNum;
@property (nonatomic, retain) NSString * rating;
@property (nonatomic, retain) NSString * website;
@property (nonatomic, retain) NSString * phone;
@property (nonatomic, retain) NSString * id;
@property (nonatomic, retain) NSString * score;

@end
